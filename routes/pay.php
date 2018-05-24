<?php

/**
 * 支付回调相关路由组
 */

Route::group(['prefix' => 'pay','namespace'=>'Pay'],function(){

    //不需要登录验证的路由
    Route::group(['middleware'=>'auth.pay'],function(){

    });

});





