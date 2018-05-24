<?php

namespace App\Http\Controllers\Weixin;

use App\Models\UserAddressModel;
use App\ModelsShop\UserOrderItemModel;
use App\ModelsShop\UserOrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderCreationController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = session('user_id');
        $infos = DB::table('user_cart')
            ->rightJoin('goods_item', 'goods_item.id', '=', 'user_cart.goods_id')
            ->select('goods_item.*','user_cart.quantity','user_cart.id as cart_id','user_cart.status as cart_status','user_cart.id as cart_id')
            ->orderBy('user_cart.id','desc')
            ->where('user_cart.user_id',$user_id)
            ->where('user_cart.status',20)
            ->get();
        $infos = object_to_array($infos);
        if(!$infos){//购物车为空时跳转
            return redirect()->route('weixin.cart_empty');//没有登录状态，跳转到顶楼页面
            exit;
        }
        foreach ($infos as $k=>$v){
        }
        return view( $this->_skin .'.user.user_order.order_creation',compact('infos'));
    }

    public function create(Request $request)
    {
        //接收参数，启用事务处理，查询laravel事务机制
        //通过地址id获取地址详细信息
        //获取所有选中的商品
        //生成订单
        $address_id = $request->get('address_id');
        $user_id =  session('user_id');
        $order_number = get_order_number($user_id);
        //写入订单总表
        DB::beginTransaction();
        try{
            $infos_address = get_address_info_by_id($user_id,$address_id);
            if($infos_address['status']!='s'){
                throw new \Exception('收货地址获取失败');
            }
            $infos_price = get_cart_info($request);
            if($infos_price['status']!='s'){
                throw new \Exception('购物车商品价格计算错误！');
            }
            $total_price_discount = $infos_price['data']['total_price_discount'];
            $total_num = $infos_price['data']['total_num'];
            $ship_fee = 0;//物流费用
            $discount_fee = 0;//折扣费用
            //后期在此处处理营销费用

            $action_order = UserOrderModel::create([
                'user_id' => $user_id,
                'order_number' => $order_number,
                'total' => sprintf("%.2f",($total_price_discount+$ship_fee-$discount_fee)),
                'total_goods_amount' => sprintf("%.2f",$total_price_discount),
                'total_quantity' => $total_num,
                'ship_fee' => sprintf("%.2f",$ship_fee),
                'discount_fee' => sprintf("%.2f",$discount_fee),
                'name' => $infos_address['data']['name'],
                'phone' => $infos_address['data']['phone'],
                'zip_code' => $infos_address['data']['zip_code'],
                'sheng_id' => $infos_address['data']['sheng_id'],
                'shi_id' => $infos_address['data']['shi_id'],
                'qu_id' => $infos_address['data']['qu_id'],
                'sheng_name' => $infos_address['data']['sheng_name'],
                'shi_name' => $infos_address['data']['shi_name'],
                'qu_name' => $infos_address['data']['qu_name'],
                'address' => $infos_address['data']['address'],
            ]);
            if(!$action_order)
            {
                throw new \Exception('订单创建失败');
            }
            $infos_cart = get_cart_item_buy_by_user_id($user_id);
            if($infos_cart['status']=='s'){
                $order_id =  $action_order;
                foreach ($infos_cart['data'] as $k=>$v){
                    $action_order_item = UserOrderItemModel::create([
                        'user_id' => $user_id,
                        'order_number' => $order_number,
                        'goods_title' => $v['goods_title'],
                        'goods_id' => $v['id'],
                        'quantity' => $v['quantity'],
                        'price_discount' => $v['price_discount'],
                        'price_market' => $v['price_market'],
                        'weight' => $v['weight']
                    ]);
                    if(!$action_order_item)
                    {
                        throw new \Exception('订单明细创建失败');
                    }
                }
            }elseif ($infos_cart['status']=='f'){
                throw new \Exception('未选择购买的商品，创建失败');
            }
            $order_log = array(
                'user_id'=>$user_id,
                'order_number' => $order_number,
                'remark'=>'创建订单',
            );
            create_order_log($order_log);
            //清理购物车中的信息
//            delete_cart_item_buy_by_user_id($user_id);
        }catch (\Exception $e){
            DB::rollBack();
            $response = array(
                'status'=>'f',
                'code'=>4000,
                'msg'=>$e->getMessage()
            );
            return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
        }
        DB::commit();
        $response = array(
            'status'=>'s',
            'code'=>1000,
            'msg'=>'创建订单成功',
            'url' =>route('weixin_order_pay',['order_number'=>$order_number])
        );
        //route('weixin_order_pay')
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
}
