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

Route::get('test', function () {
    clock()->startEvent('event_name', 'LaravelAcademy.org'); //事件名称，显示在Timeline中

    clock('Message text.'); //在Clockwork的log中显示'Message text.'
    logger('Message text.'); //也Clockwork的log中显示'Message text.'

    clock(array('hello' => 'world')); //以json方式在log中显示数组
    //如果对象实现了__toString()方法则在log中显示对应字符串，
    //如果对象实现了toArray方法则显示对应json格式数据，
    //如果都没有则将对象转化为数组并显示对应json格式数据
    // clock(new Object());

    clock()->endEvent('event_name');
});

Route::auth();
Route::Group(['namespace' => 'Account'], function() {
    // Route::get('login', ['as' => 'auth.user.login', 'uses' => 'AuthController@login']);
    // Route::get('logout',['as'=>'auth.user.logout','uses'=>'AuthController@logout']);
    // 用户空间首页
    Route::get('/user/{user_id}', ['as' => 'auth.space.index', 'uses' => 'UserController@index']);
    // 我发布的链接
    Route::get('/user/{user_id}/links', ['as' => 'auth.space.links', 'uses' => 'UserController@links'])->where(['user_id' => '[0-9]+']);
    Route::get('/user/{user_id}/coins', ['as' => 'auth.space.coins', 'uses' => 'UserController@coins'])->where(['user_id' => '[0-9]+']);
    // 我的经验
    Route::get('/user/{user_id}/exp', ['as' => 'auth.space.exp', 'uses' => 'UserController@exp'])->where(['user_id' => '[0-9]+']);
    // 我的粉丝
    Route::get('/user/{user_id}/followers', ['as' => 'auth.space.followers', 'uses' => 'UserController@followers'])->where(['user_id' => '[0-9]+']);
    // 我的关注
    Route::get('/user/{user_id}/attentions', ['as' => 'auth.space.attentions', 'uses' => 'UserController@attentions'])->where(['user_id' => '[0-9]+']);
    // 我的收藏
    Route::get('/user/{user_id}/collections', ['as' => 'auth.space.collections', 'uses' => 'UserController@collections'])->where(['user_id' => '[0-9]+']);
});

Route::get('/home', 'HomeController@index');

Route::get('/', ['as'=>'website.index', 'uses'=> 'IndexController@index']);

// 文章
// 用户
// 用户主页
// Route::get('/user/{user_id?}', ['as' => 'auth.space.index', 'uses' => 'UserController@index']);
// 获取所发的链接信息
Route::get('/user/{user_id?}/link', ['as' => 'website.user.link', 'uses' =>  'UserController@link']);

// 后台管理
Route::get('/admin', ['as' => 'website.admin.index', 'uses' => 'AdminController@index']);
Route::get('/admin/create/topics', ['as' => 'admin.topics.create', 'uses' => 'AdminController@create']);

// 通知
Route::get('/test', ['as' => 'auth.notification.index', 'uses' => 'IndexController@index']);
// 信息
Route::get('/tests', ['as' => 'auth.message.index', 'uses' => 'IndexController@index']);
// Profile
Route::get('/testss', ['as' => 'auth.profile.base', 'uses' => 'IndexController@index']);
Route::get('/testsss', ['as' => 'website.image.avatar', 'uses' => 'IndexController@index']);


// 文章管理模块
Route::Group(['namespace' => 'Link'], function(){
    
    // 查看链接
    Route::get('/link/{id}', ['as' => 'website.link.detail', 'uses' => 'LinkController@show'])->where(['id'=>'[0-9]+']);
    
    // 需要登陆的部分
    Route::Group(['middleware' => 'auth'], function (){
        
        // 创建链接
        Route::get('/link/create', ['as' => 'website.link.create', 'uses' => 'LinkController@create']);
        Route::post('/link/create', 'LinkController@store');

        // 修改链接
        Route::get('/link/{link_id}/edit', ['as' => 'website.link.edit', 'uses' => 'LinkController@edit']);
        Route::post('/link/{link_id}/edit', 'LinkController@update');
        // 删除链接
        Route::get('/link/{link_id}/delete', ['as' => 'website.link.delete', 'uses' => 'LinkController@destroy']);
        // 顶
        Route::get('/link/{link_id}/voteUp', ['as' => 'website.link.voteUp', 'uses' => 'LinkController@voteUp']);
        // 踩
        Route::get('/link/{link_id}/voteDown', ['as' => 'website.link.voteDown', 'uses' => 'LinkController@voteDown']);
    });
});


// 后台管理模块
Route::Group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => ['auth']],function(){
    // Route::resource('index', 'IndexContr')
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
    
    // 话题删除
    Route::any('topics/destroy', ['as' => 'admin.topics.destroy', 'uses' => 'TopicsController@destroy']);
    // 话题管理
    Route::resource('topics', 'TopicsController', ['only' => ['index', 'edit', 'update', 'create', 'store']]);
});

// 图片
Route::get('image/avatar/{avatar_name}',['as'=>'website.image.avatar','uses'=>'ImageController@avatar'])->where(['avatar_name'=>'[0-9]+_(small|big|middle)']);
