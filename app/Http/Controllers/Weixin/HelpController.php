<?php

namespace App\Http\Controllers\Weixin;

use App\Models\SinglepageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends BaseController
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
    public function sort_list()
    {
        return view( $this->_skin .'.web.help_sort');
    }
    /**
     * 帮助中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help_list($id)
    {
        $infos = SinglepageModel::where('sort_id',$id)->orderBy('id','desc')->paginate(15);
        return view( $this->_skin .'.web.help_list', compact('infos'));
    }
    /**
     * 帮助中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help_info($id)
    {
        $model = new SinglepageModel();
        $infos = $model::where('status',20)->find($id);
        $model::where('id',$id)->increment('view');
        return view( $this->_skin .'.web.help_info', compact('infos'));
    }
    /**
     * 关于我们
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        $id = 1;
        $infos = SinglepageModel::where('status',20)->find($id);
        return view( $this->_skin .'.web.help_info', compact('infos'));
    }

    /**
     * 联系我们
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $id = 2;
        $infos = SinglepageModel::where('status',20)->find($id);
        return view( $this->_skin .'.web.help_info', compact('infos'));
    }
}
