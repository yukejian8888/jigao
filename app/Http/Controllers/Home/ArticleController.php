<?php

namespace App\Http\Controllers\Home;

use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends BaseController
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
    public function article_list($sort_id)
    {
        //获取该分类下所有的子级分类
        $all_sort_id = get_all_articel_sort_list_child_id_by_pid($sort_id);
        $all_sort_id = $all_sort_id.$sort_id;
        $array_sort_id = explode(',',$all_sort_id);
        $infos = ArticleModel::whereIn('sort_id',$array_sort_id)->where('status',20)->orderBy('id','desc')->paginate(10);
        $infos_sort = get_article_sort_info_by_sort_id($sort_id);
        $infos_seo = array(
            'title'=>$infos_sort['name'].'-'.get_cfg_by_name('cfg_sitename'),
            'kwd'=>get_cfg_by_name('cfg_sitekeywords'),
            'desc'=>get_cfg_by_name('cfg_sitedescription'),
        );
        return view( $this->_skin .'.article_list',compact('infos','infos_sort','infos_seo'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function article_info($id)
    {
        $model = new  ArticleModel();
        $infos = $model::where('status',20)->find($id);
        $infos = object_to_array($infos);
        $model::where('id',$id)->increment('view');
        $infos_seo = array(
            'title'=>get_cfg_by_name('cfg_sitename'),
            'kwd'=>get_cfg_by_name('cfg_sitekeywords'),
            'desc'=>get_cfg_by_name('cfg_sitedescription'),
        );
        return view( $this->_skin .'.article_info',compact('infos','infos_seo'));
    }
}
