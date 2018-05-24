<?php
/**
 * 后台管理路由组
 */
Route::group(['namespace'=>'Admin'],function(){
    //不需要登录验证的接口
    Route::group(['middleware'=>'auth.admin.guest'],function(){
        Route::get('login','PassportController@showLoginForm')->name('passport.login');
        Route::post('login','PassportController@login')->name('passport.login');
        Route::get('logout','PassportController@logout')->name('passport.logout');
    });
    //需要登录验证才能操作的接口
    Route::group(['middleware'=>'auth.admin'],function(){
        Route::get('/','IndexController@index')->name('admin.index');


        //考勤管理
        Route::resource('/attendance','AttendanceController');
        //考勤打卡
        Route::post('/attendance','AttendanceController@punch')->name('admin.attendance.punch');
        //签退
        Route::post('/checkout','AttendanceController@checkout')->name('admin.attendance.checkout');
        //考勤组设置
        Route::resource('/attendance_setting','AttendanceSettingController');
        //获取需要打卡的人员列表
        Route::post('/get/attendance/user/list','AttendanceSettingController@get_user_list')->name('admin.attendance.get_user_list');
        Route::post('/get/attendance/user/info','AttendanceSettingController@get_user')->name('admin.attendance.get_user_info');
        //settings基础参数设置
        Route::resource('/settings','SettingsController');


        //文章列表
        Route::resource('/article','ArticleController');
        //文章分类
        Route::resource('/articlesort','ArticleSortController');

        //知识库分类
        Route::resource('/knowledge_sort','KnowledgeSortController');
        //知识库列表
        Route::resource('/knowledge','KnowledgeController');

        //项目列表
        Route::resource('/item','ItemController');

        //周报列表
        Route::resource('/weekly','WeeklyController');
        //周报上报
        Route::post('/weekly_reported','WeeklyController@reported')->name('admin.weekly.reported');
        //周报汇报
        Route::post('/weekly_report','WeeklyController@report')->name('admin.weekly.report');
        //汇报周报编辑
        Route::get('/weekly_reportedit/{id}','WeeklyController@reportedit')->name('weekly.reportedit');
        //汇报周报编辑提交
        Route::get('/weekly_update_report/{id}','WeeklyController@update_report')->name('weekly.update_report');

        //品牌列表
        Route::resource('/brand','BrandController');
        //品牌分类
        Route::resource('/brandsort','BrandSortController');

        //单页文档分类
        Route::resource('/singlepagesort','SinglepageSortController');
        //单页文档列表
        Route::resource('/singlepage','SinglepageController');

        //api列表
        Route::resource('/api','ApiController');

        //integral积分设置
        Route::resource('/integral','SettingsIntegralController');

        //letter_tempalte 站内信模板
        Route::resource('/letter_template','LetterTemplateController');

        //adsort广告分类
        Route::resource('/adsort','AdSortController');
        //广告列表--ad
        Route::resource('/ad','AdController');

        //友情链接列表--links
        Route::resource('/links','LinksController');
        //友情链接分类--linkssort
        Route::resource('/linkssort','LinksSortController');

        //碎片分类 blocksort
        Route::resource('/blocksort','BlockSortController');
        //碎片列表 block
        Route::resource('/block','BlockController');

        //用户组管理 manage group
        Route::resource('/manage_group','ManageGroupController');

        //会员列表 user
        Route::resource('/user','UserController');
        //公司列表
        Route::resource('/company','CompanyController');
        //角色列表
        Route::resource('/role','RoleController');
        //架构列表
        Route::resource('/organization','OrganizationController');
        //权限列表
        Route::resource('/authority','AuthorityController');
        //节点列表
        Route::resource('/node','NodeController');
        //角色权限添加写库
        Route::post('/role_authority','RoleController@role_authority')->name('role.authority');

        //会员等级列表 userlevel
        Route::resource('/userlevel','UserLevelController');

        //会员列表 user_group
        Route::resource('/user_group','UserGroupController');

        //邮件动态配置mail
        Route::resource('/mail','MailController');
        //邮件日志maillog
        Route::resource('/maillog','MailLogController');

        //短信日志maillog
        Route::resource('/sms_log','SmsLogController');

        //地区列表信息 area
        Route::resource('/area','AreaController');
        //站点管理 site
        Route::resource('/site','SiteController');

        //微信公众账号配置 wechat_settings
        Route::resource('/wechat_settings','WechatSettingsController');
        //微信支付配置 wechat_payment
        Route::resource('/wechat_payment','WechatPaymentController');
        //微信自定义菜单配置 wechat_menu
        Route::resource('/wechat_menu','WechatMenuController');

        //执行菜单创建
        Route::post('/wechat_menu_create','WechatMenuController@wechat_menu_create')->name('wechat_menu_create');

        //执行菜单删除
        Route::post('/wechat_menu_delete','WechatMenuController@wechat_menu_delete')->name('wechat_menu_delete');

        //查看微信菜单
        Route::post('/wechat_menu_list','WechatMenuController@wechat_menu_list')->name('wechat_menu_list');

        //微信回复消息 wechat_info
        Route::resource('/wechat_info','WechatInfoController');
        //相册分类
        Route::resource('/album_sort','AlbumSortController');
        Route::resource('/album_pic','AlbumPicController');

        //上传文件
        Route::post('upload','UploadController@upload')->name('admin.upload');

        //获取分类列表tree json结构
        Route::post('/sort_list_tree','AsynJsonController@sort_list_tree')->name('sort_list_tree');
        Route::post('/sort_tree_grid','AsynJsonController@sort_tree_grid')->name('sort_tree_grid');

        //后台tianbu add route



    });
});
//审批流程
Route::group(['namespace'=>'Workflow'],function(){
    //需要登录验证才能操作的接口
    Route::group(['middleware'=>'auth.admin'],function(){
        //表单工作流管理
        Route::resource('/form_workflow','FormWorkflowController');
        Route::post('/form_workflow_approval','FormWorkflowController@approval')->name('admin.form_workflow.get_approval');
        Route::post('/form_workflow_approval_user','FormWorkflowController@get_user')->name('admin.form_workflow.get_user');

        //表单设计
        Route::resource('/form_design','FormDesignController');

        //审批表单数据
        Route::resource('/form_data','FormDataController');

        //我的审批
        Route::resource('/form_approval','FormApprovalController');
        //提交审批
        Route::post('/form_approval_launch','FormApprovalController@launch')->name('admin.form_approval.launch');

    });
});






