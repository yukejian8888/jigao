<?php

namespace App\Http\Controllers\Weixin;

use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends BaseController
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
        return view( $this->_skin .'.web.news_list',compact('infos'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = new ArticleModel();
        $infos = $model::where('status',20)->find($id);
        $model::where('id',$id)->increment('view');
        return view( $this->_skin .'.web.news_info',compact('infos'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_more_list()
    {
        $infos = ArticleModel::where('status',20)->orderBy('id','desc')->paginate(2);
        if($infos){//判断条件需要调试，当数据为0条时的情况
            foreach ($infos as $k=>$v):
                $infos[$k]['href'] = route('weixin_news_info',['id'=>$v['id']]);
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

        return response()->json($reponse);
    }


}
