<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use Auth;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    
    protected $user;
    
    /**
     * 构造函数，用来获取传入的id并从数据库中获取数据，在UserController全局可用
     * @param Request $request [description]
     */
    public function __construct(Request $request) {
      $userId = $request->route()->parameter('user_id');
      $user = User::with('linkData')->find($userId);
      
      if (!$user){
        abort(404);
      }
      $this->user = $user;
      View::share("user", $user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      
      // 查看的是不是自己的信息
      if (Auth::check()){
          $who = ($this->user->id == Auth::user()->id ? '我' : '他');
      } else {
        $who = '他';
      }
     
      return view('theme::user.index')->with(compact('who'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        return view('theme::user.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * 显示$id用户分享的所有link
     * @param  int $user_id    用户id
     * @return [type]     [description]
     */
    public function links($user_id){
			// dd($user_id);
      // $user = User::find($user_id);
			// $userLinks = $this->user->linkData;
			// dd($userLinks);
      return view('theme::user/links');
    }
    
    /**
     * 我的金币
     * @return [type] [description]
     */
    public function coins() {
      
    }
    
    // public function links() {
    //   return view('theme::user.links');
    // }
}
