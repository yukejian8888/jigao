<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/**
 * 后台admin
 * 常用cms系统
 */
Route::group(['prefix' => 'home','namespace'=>'Home'],function(){
    //增加home.middleware用于在入口处增加过滤，例如关闭站点等操作。
    Route::group(['middleware'=>'home.middleware'],function(){
        Route::get('/','IndexController@index')->name('home.index');
        Route::get('/article_list/{sort_id?}','ArticleController@article_list')->name('home.article_list');
        Route::get('/article_info/{id}','ArticleController@article_info')->name('home.article_info');
    });
});





