<?php

namespace App\Http\Controllers\Weixin;

use App\ModelsShop\GoodsItemModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemInfoController extends BaseController
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
    public function show(Request $request,$id)
    {
        $model = new GoodsItemModel();
        $infos = $model::find($id);
        $model::where('id',$id)->increment('view');
        $infos['data'] = object_to_array($infos);
        return view( $this->_skin .'.web.item_info',compact('infos'));
    }
}
