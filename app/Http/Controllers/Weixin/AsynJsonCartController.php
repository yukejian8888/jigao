<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsShop\GoodsSkuModel;
use App\ModelsShop\UserCartModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsynJsonCartController extends BaseController
{
    /**
     * add_cart
     * 添加商品
     */
    public function add_cart(Request $request)
    {
        $response = add_cart_item($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * update_cart
     * 更新商品
     */
    public function update_cart(Request $request)
    {
        $response = update_cart_item($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * update_cart
     * 更新购物车商品状态
     */
    public function update_cart_status(Request $request)
    {
        $response = update_cart_status($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * get_cart_info
     * 获取已选中状态下购物车的信息
     */
    public function get_cart_info(Request $request)
    {
        $response = get_cart_info($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * delete_cart
     * 删除商品，根据sku_id删除
     */
    public function delete_cart(Request $request)
    {
        $response = delete_cart_item($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * destory
     * 清空整个购物车中的数据
     */
    public function destory()
    {
        $response = array();
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
}
