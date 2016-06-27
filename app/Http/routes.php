`<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/', ['as'=>'website.index', 'uses'=> 'IndexController@index']);

// 文章
// 创建链接
Route::get('/link/create', ['as' => 'website.link.create', 'uses' => 'LinkController@create']);
Route::post('/link/create', 'LinkController@store');
// 查看链接
Route::get('/link/{link_id}', ['as' => 'website.link.detail', 'uses' => 'LinkController@show']);
// 修改链接
Route::get('/link/{link_id}/edit', ['as' => 'website.link.edit', 'uses' => 'LinkController@edit']);
Route::post('/link/{link_id}/edit', 'LinkController@update');
// 删除链接
Route::get('/link/{link_id}/delete', ['as' => 'website.link.delete', 'uses' => 'LinkController@destroy']);
// 顶
Route::get('/link/{link_id}/voteUp', ['as' => 'website.link.voteUp', 'uses' => 'LinkController@voteUp']);
// 踩
Route::get('/link/{link_id}/voteDown', ['as' => 'website.link.voteDown', 'uses' => 'LinkController@voteDown']);

// 用户
// 用户主页
Route::get('/user/{user_id?}', ['as' => 'website.user.index', 'uses' => 'UserController@index']);
// 获取所发的链接信息
Route::get('/user/{user_id?}/link', ['as' => 'website.user.link', 'uses' =>  'UserController@link']);

// 后台管理
Route::get('/admin', ['as' => 'website.admin.index', 'uses' => 'AdminController@index']);
Route::get('/admin/create/topics', ['as' => 'admin.topics.create', 'uses' => 'AdminController@create']);




// Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()
Route::Group(['prefix'=>'admin','namespace'=>'Admin'],function(){
  // Route::get('/', 'AdminHomeController@index');
  // 站点设置
  Route::any('/setting/website', ['as' => 'admin.setting.website', 'uses' => 'SettingController@website']);
  // 时间设置
  Route::any('/setting/time', ['as' => 'admin.setting.time', 'uses' => 'SettingController@time']);
  // 注册设置
  Route::any('/setting/register', ['as' => 'admin.setting.register', 'uses' => 'SettingController@register']);
  
  // 删除链接
  Route::post('link/destroy', ['as' => 'admin.link.destroy', 'uses' => 'LinkController@destroy']);
  // link管理
  Route::resource('link', 'LinkController', ['only' => ['index', 'edit', 'update']]);
  
});
