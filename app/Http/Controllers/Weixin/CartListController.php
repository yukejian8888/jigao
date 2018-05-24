<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsShop\UserCartModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartListController extends BaseController
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
    public function cart_empty()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_cart.cart_empty',compact('infos'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_cart.cart_list',compact('infos'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_more_list()
    {
        $user_id = session('user_id');
        $infos = DB::table('user_cart')
            ->rightJoin('goods_item', 'goods_item.id', '=', 'user_cart.goods_id')
            ->select('goods_item.*','user_cart.quantity','user_cart.id as cart_id','user_cart.status as cart_status','user_cart.id as cart_id')
            ->orderBy('user_cart.id','desc')
            ->where('user_cart.user_id',$user_id)
            ->paginate(3);
        $infos = object_to_array($infos);
        foreach ($infos['data'] as $k=>$v){
            $infos['data'][$k]['href'] = route('weixin.item',['id'=>$v['id']]);
        }
        if($infos['total']>0){//判断条件需要调试，当数据为0条时的情况
            $reponse = array();
            $reponse['status']='s';
            $reponse['msg']='加载成功';
            $reponse['list'] = $infos;
        }else{
            $reponse = array();
            $reponse['status']='f';
            $reponse['msg']='暂无数据';
        }
//        dump($reponse);
        return response()->json($reponse);
    }
}
