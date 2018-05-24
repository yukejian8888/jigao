<?php
/**
 * H5页面路由组
 * @todo暂不确定微网站如何选择路由组
 */

Route::group(['prefix' => 'weixin','namespace'=>'Weixin'],function(){
    //不需要登录验证的路由
    Route::group(['middleware'=>'auth.weixin.guest'],function(){
        Route::any('/wechat','WechatController@server')->name('wechat_server');
        Route::any('/weixin','WechatController@weixin')->name('weixin');//现在用于调试，应将此处代码写入中间件
        Route::any('/oauth_callback','WechatController@oauth_callback')->name('oauth_callback');//微信授权回调
        Route::any('/notify_callback','WechatController@notify_callback')->name('notify_callback');//微信支付回调

        Route::any('/get_news','WechatController@get_news')->name('get_news');//现在用于调试，应将此处代码写入中间件

        //主页
        Route::get('/','IndexController@index')->name('weixin.index');
        //分类页
        Route::get('/item_sort','ItemSortController@index')->name('weixin_item_sort.index');
        //列表页面
        Route::get('/goods/{sort_id}','ItemListController@index')->name('weixin.goods');
        //详情页面
        Route::get('/item_info/{id}','ItemInfoController@show')->name('weixin.item');
        //商品评论页面
        Route::get('/item_comment/{id}','ItemCommentController@index')->name('weixin_item_comment');


        //帮助中心分类列表页面
        Route::get('/weixin_help_sort','HelpController@sort_list')->name('weixin_help_sort');
        //帮助中心列表页面
        Route::get('/weixin_help/{id}','HelpController@help_list')->name('weixin_help');
        //资讯中心详情页面
        Route::get('/weixin_help_info/{id}','HelpController@help_info')->name('weixin_help_info');

        //关于我们
        Route::get('/about','HelpController@about')->name('weixin_help_about');

        //联系我们
        Route::get('/contact','HelpController@contact')->name('weixin_help_contact');


        //资讯中心列表页面
        Route::get('/weixin_news','NewsController@index')->name('weixin_news');
        //资讯中心详情页面
        Route::get('/weixin_news_info/{id}','NewsController@show')->name('weixin_news_info');

        //加载更多||异步加载数据
        Route::post('/weixin_article/get_more_list/{sort_id?}','NewsController@get_more_list')->name('weixin_article.get_more_list');
        Route::post('/weixin_item_list/get_more_list/{sort_id}','ItemListController@get_more_list')->name('weixin_item_list.get_more_list');


        //登录、注册、找回密码，当weixin站点时启用，微信站点时协助绑定操作。
        Route::get('/login','PassportController@login')->name('weixin.login');
        Route::post('/login','PassportController@check_login')->name('weixin.check_login');
        //注册
        Route::get('/reg','PassportController@register')->name('weixin.reg');
        Route::post('/get_sms_code','PassportController@get_sms_code')->name('weixin.get_sms_code');
        Route::post('/check_reg','PassportController@check_register')->name('weixin.check_reg');
        //找回密码
        Route::get('/forget','PassportController@forget')->name('weixin.forget');
        Route::post('/get_forget_sms_code','PassportController@get_forget_sms_code')->name('weixin.get_forget_sms_code');
        Route::post('/check_forget','PassportController@check_forget')->name('weixin.check_forget');

        Route::get('/logout','PassportController@logout')->name('weixin.logout');

    });

    //会员相关需要登录验证的路由
    //暂定此处为会员公共部分
    Route::group(['middleware'=>'auth.weixin'],function(){

        //cart购物车列表页
        Route::get('/cart_list','CartListController@index')->name('weixin_cart_list');

        //加入购物车,更新购物车，删除购物车
        Route::post('/add_cart','AsynJsonCartController@add_cart')->name('weixin.add_cart');
        Route::post('/update_cart','AsynJsonCartController@update_cart')->name('weixin.update_cart');
        Route::post('/update_cart_status','AsynJsonCartController@update_cart_status')->name('weixin.update_cart_status');
        Route::post('/get_cart_info','AsynJsonCartController@get_cart_info')->name('weixin.get_cart_info');
        Route::post('/delete_cart','AsynJsonCartController@delete_cart')->name('weixin.delete_cart');
        Route::get('/cart_empty','CartListController@cart_empty')->name('weixin.cart_empty');

        //发现
        Route::get('/discovery_list','DiscoveryController@index')->name('weixin_discovery_list');

        //购物车结算页面(完善地址、优惠处理页面)
        Route::get('/order_creation','OrderCreationController@index')->name('weixin_order_creation');


        //结算提交订单页面(选择支付方式 支付页面)
        Route::get('/order_pay/{order_number}','OrderPayController@index')->name('weixin_order_pay');
        Route::post('/order_pay_do','OrderPayController@pay_do')->name('u_weixin.order_pay_do');
        //订单列表
        Route::get('/order_list','OrderListController@index')->name('weixin_order_list');
        //订单详情
        Route::get('/order_info','OrderInfoController@index')->name('weixin_order_info');

        //会员主页
        Route::get('/user_weixin_index','UserIndexController@index')->name('u_weixin.index');

        //账户设置
        Route::get('/u_weixin_account','UserAccountController@index')->name('u_weixin_account');

        //我的资金
        Route::get('/u_weixin_funds','UserFundsController@index')->name('u_weixin_funds');

        //我的积分
        Route::get('/u_weixin_integral','UserIntegralController@index')->name('u_weixin_integral');

        //个人资料
        Route::get('/u_weixin_info','UserInfoController@edit')->name('u_weixin_info');

        //个人资料
        Route::get('/u_weixin_info','UserInfoController@edit')->name('u_weixin_info');
        Route::post('/u_weixin_info_update','UserInfoController@update')->name('u_weixin_info.update');

        //修改密码
        Route::get('/u_weixin_password','UserPasswordController@edit')->name('u_weixin_password');
        Route::post('/u_weixin_password_update','UserPasswordController@update')->name('u_weixin_password.update');

        //设置用户名
        Route::get('/u_weixin_name','UserAccountController@edit_name')->name('u_weixin_name');
        Route::post('/u_weixin_name_update','UserAccountController@update_name')->name('u_weixin_name.update');

        //更换手机号码
        Route::get('/u_weixin_phone','UserAccountController@edit_phone')->name('u_weixin_phone');
        Route::post('/u_weixin_phone_update','UserAccountController@update_phone')->name('u_weixin_phone.update');
        Route::post('/u_weixin_phone_sms_code','UserAccountController@get_sms_code')->name('u_weixin_phone.get_sms_code');

        //更换邮箱
        Route::get('/u_weixin_email','UserAccountController@edit_email')->name('u_weixin_email');
        Route::post('/u_weixin_email_update','UserAccountController@update_email')->name('u_weixin_email.update');

        //我的消息列表页面
        Route::get('/u_weixin_letter','UserLetterController@index')->name('u_weixin_letter');

        //上传会员头像图片
        Route::post('upload_avatar','UploadController@upload_avatar')->name('upload_avatar_weixin');//上传会员头像图片
        Route::any('/weixin_cart_list/get_more_list','CartListController@get_more_list')->name('weixin_cart_list.get_more_list');
        //收货地址
        Route::get('/u_weixin_address','UserAddressController@index')->name('u_weixin_address');
        Route::get('/u_weixin_address/{id}','UserAddressController@edit')->name('u_weixin_address.edit');
        Route::get('/u_weixin_address_add','UserAddressController@add')->name('u_weixin_address.add');
        //异步获取地址信息
        Route::post('/asyn/get_address_info','UserAddressController@get_address_info')->name('u_weixin.get_address_info');
        Route::post('/asyn/get_address_list','UserAddressController@get_address_list')->name('u_weixin.get_address_list');
        //创建订单
        Route::post('/asyn/create_order','OrderCreationController@create')->name('u_weixin.create_order');



    });

});







