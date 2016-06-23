<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Topics;
use Auth;
use App\Link;
use App\Article;
use App\Http\Requests;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $action = [
        'create',
        'Create'
      ];
        return view('theme::link.create')->with(compact('action'));
    }

    /**
     * 将用户提交的网址转换成链接，加上http头
     * @param string $url 网址，
     */
    public function addHead($url){
      if (!preg_match("/^(http|ftp):/", $url)){
        return 'http://'.$url;
      }
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
          'title' =>  $request->title,
          'url'  =>  $this->addHead($request->url),
          'content' =>  $request->content,
          'user_id' =>  $request->user()->id,
        ];

        $link = Link::create($data);
        
        if($link){
          return $this->success(route('website.index', ['id'  =>  $link->id]), "发布成功！");
        } else {
          return $this->error(route('link.create'), "链接发布失败， 请稍后再试或联系管理员");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = Link::find($id);
        // dd($link->topicsInfo);
        return view('theme::link.show')->with(compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::find($id);
        $action = [
          $link->id.'/update', 
          'Update',
        ];
        $topics = Topics::all()->toArray();
        foreach ($topics as $tag) {
            if (isset($tag['topics']) && $tag['topics'] != '' ){
                // 分割话题获取数据
            }
        }
        dd($topics);
        return view('theme::link/create')->with(compact('link', 'action'));
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
        $link = Link::find($id);
        if (!$link)abort(404);
        if ($link->user_id !== $request->user()->id)abort(403);
        $request->flash();
        
        $link->title = trim($request->title);
        $link->url = $request->url;
        $link->content = $request->content;
        $link->save();
        
        return $this->success(route('user.link', ['id' => $link->user_id]), "文章编辑成功！");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Link::destroy($id);
      return $this->success(route('user.link', ['id' => Auth::user()->id]), "文章删除成功！");  
    }
    
    public function voteUp($link_id){
        $link = new Link;
        $link->voteUp($link_id);
        return redirect()->back();
        // return $this->success(url()->current(), '顶成功');
    }
    
    public function voteDown($link_id){
        $link = new Link;
        $link->voteDown($link_id);
        return redirect()->back();
        // return $this->success(url()->current(), '顶成功');
    }
}
