<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/11/27
 * Time: 下午11:24
 */
return [
    'menu_list' => array(
        //type 请设置不同参数，否则菜单折叠效果不会显示
        array('name' => '用户管理', 'type' => 'sys_user', 'ico' => 'icon-user', 'items' => array(
            array('name' => '单位管理', 'ico' => 'fa-list', 'route_name' =>  'company.index','params'=>[]),
            array('name' => '会员管理', 'ico' => 'fa-list', 'route_name' =>  'user.index','params'=>[]),
            ),
        ),

        array('name' => '项目管理', 'type' => 'sys_item', 'ico' => 'icon-menu', 'items' => array(
            array('name' => '项目列表', 'ico' => 'fa-list', 'route_name' =>  'item.index','params'=>[]),
        )
        ),

        array('name' => '信息设置', 'type' => 'sys_news', 'ico' => 'icon-grid', 'items' => array(
            array('name' => '模板管理', 'ico' => 'fa-list', 'route_name' =>  'form_design.index','params'=>[]),
            ),
        ),

        array('name' => '审批管理', 'type' => 'sys_approval', 'ico' => 'icon-list', 'items' => array(
            array('name' => '审批模板列表', 'ico' => 'fa-list', 'route_name' =>  'form_data.index','params'=>[]),
            array('name' => '我的审批', 'ico' => 'fa-list', 'route_name' =>  'form_approval.index','params'=>[]),
        ),
        ),
        array('name' => '办公管理', 'type' => 'sys_attendance', 'ico' => 'icon-social-reddit', 'items' => array(
            array('name' => '考勤规则', 'ico' => 'fa-list', 'route_name' =>  'attendance_setting.index','params'=>[]),
            array('name' => '考勤统计', 'ico' => 'fa-list', 'route_name' =>  'attendance.index','params'=>[]),
        ),
        ),
        array('name' => '架构管理', 'type' => 'sys_framework', 'ico' => 'icon-equalizer', 'items' => array(
            array('name' => '组织架构列表', 'ico' => 'fa-list', 'route_name' =>  'organization.index','params'=>[]),
            ),
        ),

//        array('name' => '信息管理', 'type' => 'sys_name', 'ico' => 'fa-cogs', 'items' => array(
            array('name' => '文章管理', 'type' => 'sys_article', 'ico' => 'icon-film', 'items' => array(
                array('name' => '文章分类', 'ico' => 'fa-list', 'route_name' =>  'articlesort.index','params'=>[]),
                array('name' => '文章列表', 'ico' => 'fa-list', 'route_name' => 'article.index','params'=>[]),
            )
            ),

        array('name' => '知识库管理', 'type' => 'sys_knowledge', 'ico' => 'icon-map', 'items' => array(
            array('name' => '知识库分类', 'ico' => 'fa-list', 'route_name' =>  'knowledge_sort.index','params'=>[]),
            array('name' => '知识库列表', 'ico' => 'fa-list', 'route_name' => 'knowledge.index','params'=>[]),
             )
        ),

        array('name' => '权限管理', 'type' => 'sys_authority', 'ico' => 'icon-link', 'items' => array(
            //array('name' => '节点列表', 'ico' => 'fa-list', 'route_name' =>  'node.index','params'=>[]),
            array('name' => '角色管理', 'ico' => 'fa-list', 'route_name' =>  'role.index','params'=>[]),
            array('name' => '节点列表', 'ico' => 'fa-list', 'route_name' =>  'authority.index','params'=>[]),

             )
        ),

        array('name' => '工作周报', 'type' => 'sys_weekly', 'ico' => 'icon-folder-alt', 'items' => array(
            array('name' => '周报列表', 'ico' => 'fa-list', 'route_name' =>  'weekly.index','params'=>[]),
        )
        ),
//            array('name' => '单页管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '单页分类', 'ico' => 'fa-list', 'route_name' =>  'singlepagesort.index','params'=>[]),
//                array('name' => '单页列表', 'ico' => 'fa-list', 'route_name' => 'singlepage.index','params'=>[]),
//            )
//            ),
//            array('name' => '相册图片管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '相册图片列表', 'ico' => 'fa-list', 'route_name' => 'album_sort.index','params'=>[]),
//            )
//            ),
////            array('name' => '案例管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
////                array('name' => '案例分类', 'ico' => 'fa-list', 'route_name' =>  'settings.index'),
////                array('name' => '案例列表', 'ico' => 'fa-list', 'route_name' => 'settings.index'),
////            )
////            ),
////            array('name' => '产品管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
////                array('name' => '产品分类', 'ico' => 'fa-list', 'route_name' =>  'settings.index'),
////                array('name' => '产品列表', 'ico' => 'fa-list', 'route_name' => 'settings.index'),
////            )
////            ),
//
//        ),
//        ), //big
//
//
//        array('name' => '用户管理', 'type' => 'sys_name', 'ico' => 'fa-cogs', 'items' => array(
//            array('name' => '用户管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '用户列表', 'ico' => 'fa-list', 'route_name' =>  'user.index','params'=>[]),
//                array('name' => '用户组管理', 'ico' => 'fa-list', 'route_name' => 'manage_group.index','params'=>[]),
//            )
//            ),
//        ),
//        ), //big
//        array('name' => '其他管理', 'type' => 'sys_name', 'ico' => 'fa-cogs', 'items' => array(
//            array('name' => '地区管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '地区列表', 'ico' => 'fa-list', 'route_name' =>  'area.index','params'=>[])
//            )
//            ),
//            array('name' => '广告管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '广告分类', 'ico' => 'fa-list', 'route_name' =>  'adsort.index','params'=>[]),
//                array('name' => '广告列表', 'ico' => 'fa-list', 'route_name' => 'ad.index','params'=>[]),
//            )
//            ),
//            array('name' => '标签碎片管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '标签碎片分类', 'ico' => 'fa-list', 'route_name' =>  'blocksort.index','params'=>[]),
//                array('name' => '标签碎片列表', 'ico' => 'fa-list', 'route_name' => 'block.index','params'=>[]),
//            )
//            ),
//            array('name' => '友情链接管理', 'type' => 'nav_name', 'ico' => 'fa-cog', 'items' => array(
//                array('name' => '友情链接分类', 'ico' => 'fa-list', 'route_name' =>  'linkssort.index','params'=>[]),
//                array('name' => '友情链接列表', 'ico' => 'fa-list', 'route_name' => 'links.index','params'=>[]),
//            )
//            ),
//        ),
//        ), //big
    )
];