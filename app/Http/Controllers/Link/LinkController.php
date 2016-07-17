<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Route;
use App\Topic;
use Auth;
use App\Link;
use App\Http\Requests;
use App\Tag;
use Cache;

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
      $action = Route::currentRouteName(); // 获取当前路由的名称
      $topics = Topic::lists('name', 'id');

      return view('theme::link.create')->with(compact('action', 'topics'));
    }

    /**
     * 将用户提交的网址转换成链接，加上http头
     * @param string $url 网址，
     */
    public function addHead($url){
      if (!preg_match("/^(http|ftp):/", $url)){
        return 'http://'.$url;
      } else {
				return $url;
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
					'published_at' => Carbon::now(),
        ];
				
				// 保存数据
        $link = Link::create($data);
        $link->topicss()->attach($request->topics_list);
        
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
        // $link = Link::find($id);
        // dd($id);
        $link = Cache::remember('link.show.'.$id, Setting()->get('website_cache_time'), function() use ($id) {
            return Link::find($id);
        });
        
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
        $date = new Carbon($link->published_at);
        $topics = Topic::lists('name', 'id');
        
        return view('theme::link/edit')->with(compact('link', 'topics'));
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
			// dd($request);
        $link = Link::find($id);
        if (!$link)abort(404);
        if ($link->user_id !== $request->user()->id)abort(403);
        $request->flash();
				$data = $request;
				// dd($data);
				
        $link->update($request->except('id'));
        $link->topicss()->sync($request->topics_list);
        
        return $this->success(route('auth.space.links', ['id' => $link->user_id]), "文章编辑成功！");
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
				Cache::forget('links.index'); // 删除缓存，让首页重建缓存
				Cache::forget("link.show.".$link_id);
        return redirect()->back();
        // return $this->success(url()->current(), '顶成功');
    }
    
    public function voteDown($link_id){
        $link = new Link;
        $link->voteDown($link_id);
				 // 删除缓存，更新数据
				Cache::forget('links.index');
				Cache::forget("link.show.".$link_id);
        return redirect()->back();
        // return $this->success(url()->current(), '顶成功');
    }
}
