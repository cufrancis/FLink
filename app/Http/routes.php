<?php

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

// 创建链接
Route::get('/link/create', ['as' => 'link.create', 'uses' => 'LinkController@create']);
Route::post('/link/create', 'LinkController@store');
// 查看链接
Route::get('/link/{link_id}', ['as' => 'link.detial', 'uses' => 'LinkController@show']);
// 编辑链接
Route::get('/link/{link_id}/edit', ['as' => 'link.edit', 'uses' => 'LinkController@edit']);
Route::post('/link/{link_id}/update', 'LinkController@update');
// 删除链接
Route::get('/link/{link_id}/delete', ['as' => 'link.delete', 'uses' => 'LinkController@destroy']);


Route::get('/user/{user_id?}', 'UserController@index');
// 获取所发的链接信息
Route::get('/user/{user_id?}/link', ['as' => 'user.link', 'uses' =>  'UserController@link']);
