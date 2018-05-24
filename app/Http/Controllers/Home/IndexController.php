<?php

namespace App\Http\Controllers\Home;

use App\Models\ArticleModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpSms;

class IndexController extends BaseController
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
        $infos = '';
        $infos_seo = array(
            'title'=>get_cfg_by_name('cfg_sitename'),
            'kwd'=>get_cfg_by_name('cfg_sitekeywords'),
            'desc'=>get_cfg_by_name('cfg_sitedescription'),
        );
        return view( $this->_skin .'.index',compact('infos','infos_seo'));
    }
}
