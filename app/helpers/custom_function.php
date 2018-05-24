<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */

if (!function_exists('list_to_tree')) {
    /**
     * 处理调用分类相关的数据
     * @access public
     * @param array $type_model 要获取的模型类
     * @return array
     */
    function list_to_tree($type_model)
    {
        if ($type_model == 'singlepage') {
            $model = new \App\Models\SinglepageSortModel();
        } elseif ($type_model == 'article') {
            $model = new \App\Models\ArticleSortModel();
        } elseif ($type_model == 'brand') {
            $model = new \App\Models\BrandSortModel();
        } elseif ($type_model == 'block') {
            $model = new \App\Models\BlockSortModel();
        } elseif ($type_model == 'links') {
            $model = new \App\Models\LinksSortModel();
        } elseif ($type_model == 'ad') {
            $model = new \App\Models\AdSortModel();
        } elseif ($type_model == 'userlevel') {
            $model = new \App\Models\UserLevelModel();
        } elseif ($type_model == 'site') {
            $model = new \App\Models\SiteModel();
        } elseif ($type_model == 'area') {
            $model = new \App\Models\AreaModel();
        }
        $infos = $model::where('pid', 0)->get(['id', 'pid', 'name']);
        $tree = array('0' => '---请选择所属分类---');
        foreach ($infos as $k => $v) {
            $tree[$v['id']] = $v['name'];
            $second_infos = $model::where('pid', $v['id'])->get(['id', 'pid', 'name']);
            foreach ($second_infos as $sub_k => $sub_v) {
                $tree[$sub_v['id']] = ' |--' . $sub_v['name'];
                //暂时隐藏，本系统目前支持最多3个级别
//                $three_infos = $model::where('pid', $sub_v['id'])->get(['id', 'pid', 'name']);
//                foreach ($three_infos as $sub_m => $sub_n) {
//                    $tree[$sub_n['id']] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--' . $sub_n['name'];
//                }
            }
        }
        return $tree;
    }
}

if (!function_exists('get_sort_children')) {
    /**
     * 处理调用分类相关的数据
     * @access public
     * @param array $type_model 要获取的模型类
     * @return array
     */
    function get_sort_children($type_model,$id)
    {
        if ($type_model == 'singlepage') {
            $model = new \App\Models\SinglepageSortModel();
        } elseif ($type_model == 'article') {
            $model = new \App\Models\ArticleSortModel();
        } elseif ($type_model == 'brand') {
            $model = new \App\Models\BrandSortModel();
        } elseif ($type_model == 'block') {
            $model = new \App\Models\BlockSortModel();
        } elseif ($type_model == 'links') {
            $model = new \App\Models\LinksSortModel();
        } elseif ($type_model == 'ad') {
            $model = new \App\Models\AdSortModel();
        } elseif ($type_model == 'userlevel') {
            $model = new \App\Models\UserLevelModel();
        } elseif ($type_model == 'site') {
            $model = new \App\Models\SiteModel();
        } elseif ($type_model == 'area') {
            $model = new \App\Models\AreaModel();
        }elseif ($type_model == 'webpage_sort') {
            $model = new \App\Models\WebpageSortModel();
        }elseif ($type_model == 'wechat_menu') {
            $model = new \App\ModelsWechat\WechatMenuModel();
        }
        $str = '';
        $infos = $model::where('pid', $id)->get(['id', 'pid']);
        foreach ($infos as $k => $v) {
            $str .= $v['id'].',';
            $second_infos = $model::where('pid', $v['id'])->get(['id', 'pid', 'name']);
            if($second_infos){
                $str .=  get_sort_children($type_model,$v['id']);//无限级分类处理
            }
        }
        return $str;
    }
}
if (!function_exists('get_sort_name')) {
    /**
     * get_sort_name
     */
    function get_sort_name($sort_id, $type_model)
    {
        if ($type_model == 'ad') {
            $model = new App\Models\AdSortModel();
        } elseif ($type_model == 'block') {
            $model = new App\Models\BlockSortModel();
        } elseif ($type_model == 'links') {
            $model = new App\Models\LinksSortModel();
        } elseif ($type_model == 'singlepage') {
            $model = new App\Models\SinglepageSortModel();
        } elseif ($type_model == 'brand') {
            $model = new App\Models\BrandSortModel();
        } elseif ($type_model == 'article') {
            $model = new App\Models\ArticleSortModel();
        } elseif ($type_model == 'userlevel') {
            $model = new App\Models\UserLevelModel();
        } elseif ($type_model == 'site') {
            $model = new \App\Models\SiteModel();
        } elseif ($type_model == 'area') {
            $model = new \App\Models\AreaModel();
        } elseif ($type_model == 'webpage_sort') {
            $model = new \App\Models\WebpageSortModel();
        } elseif ($type_model == 'account_password_sort') {
            $model = new \App\Models\AccountPasswordSortModel();
        } elseif ($type_model == 'knowledge') {
            $model = new \App\Models\KnowledgeSortModel();
        }
        $infos = $model::where('id', (int)$sort_id)->select(['name'])->first();
        if($infos){
            $name = $infos->name;
        }else{
            $name = '';
        }
        return $name;
    }
}
if (!function_exists('get_user_manage_group')) {
    /**
     * 处理调用分类相关的数据
     * @access public
     * @param array $type_model 要获取的模型类
     * @return array
     */
    function get_user_manage_group()
    {
        $model = new \App\Models\ManageGroupModel();
        $tree = array();
        $infos = $model::orderBy('id','asc')->get(['id', 'name']);
        foreach($infos as $k=>$v){
            $tree[$v['id']] = $v['name'];
        }
        return $tree;
    }
}
if (!function_exists('get_manage_group_info_bymark')) {
    /**
     * 处理调用分类相关的数据
     * @access public
     * @param array $type_model 要获取的模型类
     * @return array
     */
    function get_manage_group_info_bymark($mark)
    {
        $model = new \App\Models\ManageGroupModel();
        $infos = $model::where('mark',$mark)->first();
        return $infos;
    }
}
if (!function_exists('get_manage_group_info_default')) {
    /**
     * 调用默认分组
     * @access public
     * @return array
     */
    function get_manage_group_info_default()
    {
        $model = new \App\Models\ManageGroupModel();
        $infos = $model::where('status_default',10)->first();
        return $infos;
    }
}
if (!function_exists('get_cfg_by_name')) {
    /**
     * 通过配置名称获取配置信息
     */
    function get_cfg_by_name($name)
    {
        $infos = \App\Models\SettingsModel::where('config_name',$name)->first();
        return $infos['config_value'];
    }
}
if (!function_exists('check_pic_url')) {
    /*
     * 检查图片的路径
     *
     */
    function check_pic_url($pic_url)
    {
        //判断是否包含http或者https
        if (preg_match('/(http:\/\/)|(https:\/\/)/i', $pic_url)) {
            return $pic_url;
        }else{
            $web_url = get_cfg_by_name('cfg_domain');
            return $web_url['config_value'].$pic_url;
        }
    }
}
if (!function_exists('get_area_info_by_id')) {
    /*
     * 获取地区信息
     * $id
     */
    function get_area_info_by_id($id)
    {
        $model = new \App\Models\AreaModel();
        $infos = $model::find($id);
        $infos = object_to_array($infos);
        return $infos['name'];
    }
}
if (!function_exists('get_area_info')) {
    /**
     * get_area_info
     * 获取地区信息
     */
    function get_area_info($type, $area_id = '')
    {
        $model = new \App\Models\AreaModel();
        $response = array();
        if ($type == 'area_sheng') {//sheng
            $response = $model::where('pid',0)->select('name as text','id')->get();
            $response = object_to_array($response);
            $responses = array_merge(array(array('text' =>'请选择省份', 'id'=>0)),$response);
            return $responses;
        } elseif ($type == 'area_shi') {//shi
            if ($area_id == 0) {
                $response = array('text' =>'请选择城市', 'id'=>0);
                return $response;
            }
            $response = $model::where('pid',$area_id)->select('name as text','id')->get();
            $response = object_to_array($response);
            $response = array_merge(array(array('text' =>'请选择城市', 'id'=>0)),$response);
            return $response;
        } elseif ($type == 'area_qu') {//qu
            if ($area_id == 0) {
                $response = array('text' =>'请选择区县', 'id'=>0);
                return $response;
            }
            $response = $model::where('pid',$area_id)->select('name as text','id')->get();
            $response = object_to_array($response);
            $response = array_merge(array(array('text' =>'请选择区县', 'id'=>0)),$response);
            return $response;
        }
    }
}