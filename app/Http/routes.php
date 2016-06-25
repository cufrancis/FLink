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
Route::get('/link/create', ['as' => 'link.create', 'uses' => 'LinkController@create']);
Route::post('/link/create', 'LinkController@store');
// 查看链接
Route::get('/link/{link_id}', ['as' => 'link.detial', 'uses' => 'LinkController@show']);
// 修改链接
Route::get('/link/{link_id}/edit', ['as' => 'link.edit', 'uses' => 'LinkController@edit']);
Route::post('/link/{link_id}/edit', 'LinkController@update');
// 删除链接
Route::get('/link/{link_id}/delete', ['as' => 'link.delete', 'uses' => 'LinkController@destroy']);
// 顶
Route::get('/link/{link_id}/voteUp', ['as' => 'link.voteUp', 'uses' => 'LinkController@voteUp']);
// 踩
Route::get('/link/{link_id}/voteDown', ['as' => 'link.voteDown', 'uses' => 'LinkController@voteDown']);

// 用户
// 用户主页
Route::get('/user/{user_id?}', ['as' => 'user.index', 'uses' => 'UserController@index']);
// 获取所发的链接信息
Route::get('/user/{user_id?}/link', ['as' => 'user.link', 'uses' =>  'UserController@link']);

// 后台管理
Route::get('/admin', ['as' => 'website.admin', 'uses' => 'AdminController@index']);
