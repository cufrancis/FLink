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

// 创建文章
Route::get('/article/create', ['as'=> 'article.create', 'uses'=>'ArticleController@create']);
Route::post('/article/store', 'ArticleController@store');
// 更新文章
Route::post('article/{article_id}/update', 'ArticleController@update');

Route::get('/article/{id}', 'ArticleController@show');
// 用户编辑文章
Route::get('/article/{article_id}/edit', 'ArticleController@edit');



Route::get('/user/{user_id?}', 'UserController@index');
// 获取所发的链接信息
Route::get('/user/{user_id?}/article', [
  'as' => 'user.article.list', 'uses' =>  'UserController@article']);
