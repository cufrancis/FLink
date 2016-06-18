<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Http\Requests;

class ArticleController extends Controller
{
    // protected $article;
    // 
    // public function __construct(Request $request) {
    //   $articleId = $request->route()->parameter('article_id');
    //   $article = Article::find($articleId);
    //   
    //   if (!$article)abort(404);
    //   $this->article = $article;
    // }
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
        return view('theme::article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = [
          'title' =>  $request->title,
          'link'  =>  $request->link,
          'content' =>  $request->content,
          'author_id' =>  $request->user()->id,
        ];
        // dd($data);
        $article = Article::create($data);
        
        if($article){
          return $this->success(route('website.index', ['id'  =>  $article->id]), "发布成功！");
        } else {
          return $this->error(route('article.create'), "链接发布失败， 请稍后再试或联系管理员");
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
        $article = Article::find($id);
        return view('theme::article.show')->with(compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $action = [
          $article->id.'/update', 
          'Edit',
        ];
        return view('theme::article/create')->with(compact('article', 'action'));
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
        $article = Article::find($id);
        if (!$article)abort(404);
        if ($article->author_id !== $request->user()->id)abort(403);
        $request->flash();
        
        $article->title = trim($request->title);
        $article->link = $request->link;
        $article->content = clean($request->content);
        
        $article->save();
        return $this->success(route('user.article.list', ['id' => $article->id]), "文章编辑成功！");
        // if ($)
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
}
