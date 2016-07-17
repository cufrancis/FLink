<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Overtrue\Pinyin\Pinyin;
use App\Topic;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter =  $request->all();
        $query = Topic::query();

        /*问题标题过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('name','like', '%'.$filter['word'].'%');
        }

        /*时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }


        // $tags = $query->orderBy('updated_at','desc')->paginate(20);
        
        $topics = $query->orderBy('updated_at', 'desc')->paginate(20);
        return view("adminTheme::topics.index")->with(compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('adminTheme::topics.create');
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
        $pinyin = new Pinyin();
        $data = [
            'name' =>  $request->name,
            'name_lower'    =>  $pinyin->permalink(strtolower($request->name)),
            'desc'  =>  $request->desc,
        ];
        $topics = Topic::create($data);
        
        if($topics){
          return $this->success(route('admin.topics.index'), "发布成功！");
        } else {
          return $this->error(route('admin.topics.create'), "链接发布失败， 请稍后再试或联系管理员");
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
        //
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
    public function destroy(Request $request)
    {
        // $tagIds = $request->input('id');
        Topic::destroy($request->id);
        return $this->success(route('admin.topics.index'),'标签删除成功');

    }
}
