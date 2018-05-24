<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('get_page_sort_list_by_id')) {
    /**
     * 获取用户信息
     * @param $user_id 通过用户id
     */
    function get_page_sort_list_by_id($id)
    {
        $model = new \App\Models\SinglepageSortModel();
        $info = $model::where('pid',$id)->get();
        if($info):

            foreach ($info as $k=>$v):
                $info_sub = $model::where('pid',$v['id'])->get();
                $info[$k]['sub_item'] = $info_sub;
            endforeach;
        endif;
        return $info;
    }
}

if (!function_exists('get_page_sort_info_by_id')) {
    /**
     * 获取用户信息
     * @param $user_id 通过用户id
     */
    function get_page_sort_info_by_id($id)
    {
        $model = new \App\Models\SinglepageSortModel();
        $info = $model::where('id',$id)->where('status',20)->first();
        return $info;
    }
}
if (!function_exists('get_link_list_by_sortid')) {
    /**
     * 获取link信息
     * @param $sort_id 通过分类id
     */
    function get_link_list_by_sortid($sort_id)
    {
        $model = new \App\Models\LinksModel();
        $info = $model::where('sort_id',$sort_id)->where('status',20)->get();
        return $info;
    }
}
if (!function_exists('get_ad_list_by_sortid')) {
    /**
     * 获取ad信息
     * @param $sort_id 通过分类id
     */
    function get_ad_list_by_sortid($sort_id)
    {
        $model = new \App\Models\AdModel();
        $info = $model::where('sort_id',$sort_id)->where('status',20)->get();
        return $info;
    }
}

if (!function_exists('get_block_list_by_sort_id')) {
    /**
     * 获取block列表信息
     * @param $sort_id 通过分类id
     */
    function get_block_list_by_sort_id($sort_id)
    {
        $model = new \App\Models\BlockModel();
        $infos = $model::where('sort_id',$sort_id)->where('status',20)->get();
        $infos = object_to_array($infos);
        if($infos):
            $response = array(
                'status'=>'s',
                'code'=>1000,
                'msg'=>'加载成功',
                'list'=>$infos
            );
        else:
            $response = array(
                'status'=>'f',
                'code'=>4000,
                'msg'=>'暂无数据'
            );
        endif;
        return $response;
    }
}
if (!function_exists('get_block_info_by_id')) {
    /**
     * 获取block详细信息
     * @param $id 通过block碎片id
     */
    function get_block_info_by_id($id)
    {
        $model = new \App\Models\BlockModel();
        $infos = $model::find($id);
        $infos = object_to_array($infos);
        return $infos['title'];
    }
}
if (!function_exists('get_article_list_by_flag')) {
    /**
     * 获取ad信息
     * @param $sort_id 通过分类id
     */
    function get_article_list_by_flag($limit='5',$flag='')
    {
        $model = new \App\Models\ArticleModel();
        $info = $model::where('status',20)->select('id','title','user_id','description','view','pic','created_at')->orderBy('id','desc')->take($limit)->get();
        $info = object_to_array($info);
        return $info;
    }
}

if (!function_exists('get_article_list_by_random')) {
    /**
     * 获取文章随机信息
     */
    function get_article_list_by_random($limit='5')
    {
        //随机条件设置
        $infos_count = get_article_list_count();
        $chazhi = $infos_count-$limit;
        $skip = 0;
        if(($chazhi)>0){
            $skip = rand(0,$chazhi);
        }
        $model = new \App\Models\ArticleModel();
        $info = $model::where('status',20)
            ->select('id','title','user_id','description','view','pic','created_at')
            ->orderBy('id','desc')
            ->skip($skip)
            ->take($limit)
            ->get();
        $info = object_to_array($info);
        return $info;
    }
}
if (!function_exists('get_article_list_count')) {
    /**
     * 获取总条数
     */
    function get_article_list_count()
    {
        $status = 20;//审核状态，10禁用，20启用
        $model = new \App\Models\ArticleModel();
        $infos_count = $model::where('status',$status)
            ->count();
        return $infos_count;
    }
}

if (!function_exists('get_all_article_sort_list_by_pid')) {
    /**
     * 通过父级id获取所有商品分类列表
     * @param $pid 分类父级id
     */
    function get_all_article_sort_list_by_pid($pid)
    {
        $model = new \App\Models\ArticleSortModel();
        $infos = $model::where('pid',$pid)->where('status',20)->get();
        $infos = object_to_array($infos);
        if($infos):
            foreach ($infos as $k=>$v):
                $infos_sub = get_all_article_sort_list_by_pid($v['id']);
                $infos[$k]['sub_item'] = $infos_sub;
            endforeach;
        endif;
        return $infos;
    }
}
if (!function_exists('get_all_articel_sort_list_child_id_by_pid')) {
    /**
     * 通过父级id获取所有商品分类id信息
     * @param $pid 分类父级id
     */
    function get_all_articel_sort_list_child_id_by_pid($pid)
    {
        $model = new \App\Models\ArticleSortModel();
        $infos = $model::where('pid',$pid)->where('status',20)->get();
        $infos = object_to_array($infos);
        $str = '';
        if($infos):

            foreach ($infos as $k=>$v):
                $str .= $v['id'].',';
                $infos_sub = get_all_article_sort_list_by_pid($v['id']);
                if($infos_sub){
                    foreach ($infos_sub as $sub_k=>$sub_v){
                        $str .= $sub_v['id'].',';
                    }
                }
            endforeach;
        endif;
        return $str;
    }
}

if (!function_exists('get_article_sort_info_by_sort_id')) {
    /**
     * 通过分类id获取分类信息
     * @param $sort_id 分类id
     */
    function get_article_sort_info_by_sort_id($sort_id)
    {
        $model = new \App\Models\ArticleSortModel();
        $infos = $model::where('id',$sort_id)->where('status',20)->first();
        $infos = object_to_array($infos);
        return $infos;
    }
}
if (!function_exists('get_article_count')) {
    /**
     * 获取所有文章的总数量
     */
    function get_article_count()
    {
        $model = new \App\Models\ArticleModel();
        $infos = $model::count();
        return $infos;
    }
}
if (!function_exists('get_all_article_sort_list')) {
    /**
     * 获取所有的分类
     */
    function get_all_article_sort_list()
    {
        $model = new \App\Models\ArticleSortModel();
        $infos = $model::where('status',20)->orderBy('order_by','asc')->get();
        $infos = object_to_array($infos);
        return $infos;
    }
}