<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsShop\GoodsItemModel;
use App\ModelsShop\GoodsSkuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemListController extends BaseController
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
    public function index($id)
    {
        $infos['id'] = $id;
        return view( $this->_skin .'.web.item_list',compact('infos'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_more_list($sort_id)
    {
//        $sort_id = $request->sort_id;
        //通过分类id获取所有子级分类id,然后获得所有goods_id
        //通过goods_id 查询所有相关的sku
        $sort_id_str = get_shop_sort_children('goods_item_sort',$sort_id).$sort_id;
        $sort_id_array =  explode(',',$sort_id_str);
        $infos = DB::table('goods_item')
            ->rightJoin('goods_sku', 'goods_item.id', '=', 'goods_sku.goods_id')
            ->select('goods_sku.*','goods_item.title as goods_item_title')
            ->orderBy('goods_sku.id','desc')
            ->whereIn('goods_item.sort_id',$sort_id_array)
            ->paginate(3)
            ->toArray();
//        dump($infos);
        $infos =  json_decode(json_encode($infos),true);//对象转数组
//        dump($infos);
        if($infos['total']>0){//判断条件需要调试，当数据为0条时的情况
            foreach ($infos['data'] as $k=>$v):

//                $infos_list[$k]['sku_title'] = $v['title'];
                $infos['data'][$k]['sku_title'] = $v['goods_item_title'].$v['title'];
                $infos['data'][$k]['href'] = route('weixin_item_info',['id'=>$v['id'],'sort_id'=>$sort_id]);
            endforeach;
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
