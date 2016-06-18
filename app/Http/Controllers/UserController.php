<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Auth;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
  
    protected $user;
  
    public function __construct(Request $request) {
      $userId = $request->route()->parameter('user_id');
      $user = User::with('articleData')->find($userId);
      
      if (!$user)abort(404);
      $this->user = $user;
      View::share("userInfo", $user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      // dd($this->user->articleData);
      
      // 查看的是不是自己的信息
      $who = ($this->user->id == Auth::user()->id ? '我' : '他');
      // dd($user->getArticleInfo);
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
        // dd($user);
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
    
    public function article(){
      // dd($this->user->getArticleInfo);
      return view('theme::user/article');
    }
}
