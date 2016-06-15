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

Route::get('/article/create', ['as'=> 'article.create', 'uses'=>'ArticleController@create']);

Route::get('/article/{id}', 'ArticleController@show');

Route::post('/article/create', 'ArticleController@store');
