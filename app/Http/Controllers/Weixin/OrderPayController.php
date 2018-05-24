<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsShop\UserOrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderPayController extends BaseController
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
    public function index($order_number)
    {
        $model = new UserOrderModel();
        $user_id = session('user_id');
        $infos = $model::where('order_number',$order_number)->where('user_id',$user_id)->select('id','order_number','user_id','total')->first();
        $infos = object_to_array($infos);
        return view( $this->_skin .'.user.user_order.order_pay',compact('infos'));
    }

    public function pay_do(Request $request)
    {
        $pay_id = $request->get('pay_id');
        $order_number = $request->get('order_number');
        //目前先基于微信支付

        //1、查询一次支付状态，先有系统的支付状态
        $infos_order = get_order_info_by_order_number($order_number);
        if ($infos_order['status_pay'] == 10) {//支付状态,10待支付，11已支付,12申请退款，13退款成功
            //未支付订单，查询一次微信订单信息，确认是否支付
            $order_query = get_query_order_by_out_trade_no($order_number);
            if($order_query['code'] == '4000'){//未支付，获取repay_id,并判断创建时间是否过期，过期重新统一下单
                $remark_pay = json_decode($infos_order['remark_pay'],true);
                if((time()-$remark_pay['add_time'])>3600*2){//超时，重新下单
                    $order_create = create_order($order_number,'JSAPI');//创建订单
                    $unifiedorder = unifiedorder($order_number,$order_create);//统一下单
                    if($unifiedorder['status']=='s'){//订单创建成功
                        $infos = array(
                            'status'=>'s',
                            'code'=>1000,
                            'msg'=>$unifiedorder['msg'],
                            'order_info' => $infos_order,
                            'pay_config' => get_config_jssdk_payment($unifiedorder['data']['prepay_id']),
                            'pay_icon' => '/public/style/user/images/wechat_icon.png'
                        );
                    }elseif($unifiedorder['status']=='f'){//订单创建失败
                        $infos = array(
                            'status'=>'f',
                            'code'=>4000,
                            'msg'=>$unifiedorder['msg'],
                            'order_info' => $infos_order,
                        );
                    }
                }else{//不超时，正常下单
                    $infos = array(
                        'status'=>'s',
                        'code'=>1000,
                        'msg'=>'未支付订单',
                        'order_info' => $infos_order,
                        'pay_config' => get_config_jssdk_payment($remark_pay['prepay_id']),
                        'pay_icon' => '/public/style/user/images/wechat_icon.png'
                    );
                }
            }elseif ($order_query['code']==4010){//未有订单，需要创建
                $order_create = create_order($order_number,'JSAPI');//创建订单
                $unifiedorder = unifiedorder($order_number,$order_create);//统一下单
                if($unifiedorder['status']=='s'){//订单创建成功
                    $infos = array(
                        'status'=>'s',
                        'code'=>1000,
                        'msg'=>$unifiedorder['msg'],
                        'pay_config' => get_config_jssdk_payment($unifiedorder['data']['prepay_id']),
                        'order_info' => $infos_order,
                        'pay_icon' => '/public/style/user/images/wechat_icon.png'
                    );
                }elseif($unifiedorder['status']=='f'){//订单创建失败
                    $infos = array(
                        'status'=>'f',
                        'code'=>4000,
                        'msg'=>$unifiedorder['msg'],
                        'order_info' => $infos_order,
                    );
                }
            }
        } elseif ($infos_order['status_pay'] == 11) {//11已支付
            $infos = array(
                'status'=>'s',
                'code'=>1010,
                'msg'=>'已支付',
                'order_info' => $infos_order
            );
        }
        return view( $this->_skin .'.user.user_order.order_pay_do',compact('infos'));
    }
    
}
