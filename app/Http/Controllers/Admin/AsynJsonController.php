<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Home\BaseController;
use App\Models\AdSortModel;
use App\Models\AreaModel;
use App\Models\ArticleSortModel;
use App\Models\BlockSortModel;
use App\Models\BrandSortModel;
use App\Models\LinksSortModel;
use App\Models\SinglepageSortModel;
use App\Models\SiteModel;
use App\Models\UserLevelModel;
use App\ModelsWechat\WechatMenuModel;
use Html;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsynJsonController extends BaseController
{
    //分类数据json调用
    public function sort_list_tree(Request $request)
    {
        if ($request->has('sort_name')):
            $sort_name = $request->sort_name;
            switch ($sort_name):
                case 'ad_sort':
                    $model = new AdSortModel();
                    break;
                case 'article_sort':
                    $model = new ArticleSortModel();
                    break;
                case 'singlepage_sort':
                    $model = new SinglepageSortModel();
                    break;
                case 'brand_sort':
                    $model = new BrandSortModel();
                    break;
                case 'block_sort':
                    $model = new BlockSortModel();
                    break;
                case 'links_sort':
                    $model = new LinksSortModel();
                    break;
                case 'userlevel':
                    $model = new UserLevelModel();
                    break;
                case 'site':
                    $model = new SiteModel();
                    break;
                case 'area'://此处虽然加上了area数据的处理，但不建议遍历使用
                    $model = new AreaModel();
                    break;
                case 'wechat_menu':
                    $model = new WechatMenuModel();
                    break;
            endswitch;
            $infos = $model::get(['id','pid','name as text'])->toArray();
            $tree = array_to_tree($infos, 'id', 'pid', 'children');
            $tree = array_merge(array(array('id' => 0, 'text' => '全部文档')), $tree);
        else:
            $tree = array(array('id' => 0, 'text' => '全部文档'));
        endif;
        return response()->json($tree)->header('Content-Type','text/html;charset=utf-8');
    }

    //tree grid数据调用
    public function sort_tree_grid(Request $request)
    {
        if ($request->has('sort_name')):
            $sort_name = $request->sort_name;
            switch ($sort_name):
                case 'ad_sort':
                    $route_name = 'adsort';
                    $model = new AdSortModel();
                    break;
                case 'article_sort':
                    $route_name = 'articlesort';
                    $model = new ArticleSortModel();
                    break;
                case 'singlepage_sort':
                    $route_name = 'singlepagesort';
                    $model = new SinglepageSortModel();
                    break;
                case 'brand_sort':
                    $route_name = 'brandsort';
                    $model = new BrandSortModel();
                    break;
                case 'block_sort':
                    $route_name = 'blocksort';
                    $model = new BlockSortModel();
                    break;
                case 'links_sort':
                    $route_name = 'linkssort';
                    $model = new LinksSortModel();
                    break;
                case 'userlevel':
                    $route_name = 'userlevel';
                    $model = new UserLevelModel();
                    break;
                case 'wechat_menu':
                    $route_name = 'wechat_menu';
                    $model = new WechatMenuModel();
                    break;
                case 'site':
                    $route_name = 'site';
                    $model = new SiteModel();
                    break;
                case 'area'://此处虽然加上了area数据的处理，但不建议遍历使用
                    $route_name = 'area';
                    $model = new AreaModel();
                    break;
            endswitch;
            $infos = $model::get(['*','pid as _parentId'])->toArray();
            foreach ($infos as $k => $v) {
                if($v['_parentId']==0){
                    unset($infos[$k]['_parentId']);
                }
                $infos[$k]['status_name'] = Html::radio(['20' => '启用', '10' => '禁用'],$v['status']);
                $url_delete = route($route_name.'.destroy',['id'=>$v['id']]);
                $name = $v['name'];
                $infos[$k]['action'] = '<span class="dogo-treegrid-action"><a href="'.route($route_name.'.edit',['id'=>$v['id']]).'" title="编辑"><i class="fa fa-edit"> </i></a>&nbsp;'.
                    '<a href="javascript:void(0)" onClick="dogoDeleteTreegrid(\'' . $url_delete . '\',\''.$name.'\')" title="删除"><i class="fa fa-trash-o"> </i></a></span>';
            }
            $total = $model::count();
        else:
            $total = 0;
            $infos = array();
        endif;
        $array = array();
        $array['total'] = $total;
        $array['rows'] = $infos;
        return response()->json($array)->header('Content-Type','text/html;charset=utf-8');
    }
}
