<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable=['title', 'url', 'user_id'];
    
    /**
     * 根据传入的tag处理
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function updateTags($string, $id){
        // 先查询数据库中有没有这个Tag，如果有，在link_tag表中插入tag_id 
        // 如果没有，先在数据库中创建tag，然后执行第一步
        // $tmp = self::find($id);
        $string = explode(",", $string);
        $tagsModel = new Tag();
        for ($i=0; $i < count($string); $i++) { 
            $tmps[$i] = Tag::where('name', $string[$i])->get()->toArray();            
        }
        // dd($string);
        for ($x=0; $x < count($tmps); $x++) { 
            if (empty($tmps[$x][0])) {
                // 在Tag 模型中创建标签
                $data = ['name'  =>  $string[$x]];
                if(Tag::create($data)){
                    // 创建成功
                } else {
                    // 创建失败
                }
                
            }
        }
        if (empty($tmps[2][0])) {
            dd("no");
        }
        foreach ($tmps as $tmp) {
            
        }

        
        // $tmp->tagsInfo()->attach($string[0]);
        dd($string);
    }
    
    /**
     * 获取链接所属用户的信息
     * @return [type] [description]
     */
    public function userInfo(){
      return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    /**
     * 获取链接的话题信息，多对多关系
     * @return [type] [description]
     */
    // public function topicsInfo(){
    //     
    //     // 第一个参数是我们最终希望访问的模型的名称，第二个参数是中间模型的名称
    //     // 第三个参数是中间模型的外键名，第四个参数是最终模型的外键名
    //     return $this->belongsToMany('App\Topics', 'link_topics', 'link_id', 'topic_id');
    // }
    
    public function tags(){
        return $this->belongsToMany('App\Tag', 'link_tags')->withTimestamps();
    }
    
    /**
     * 多对多关联，话题
     * @return [type] [description]
     */
    public function topicss(){
        // return $this->belongsToMany('App\Topic', 'link_topics', 'link_id', 'topic_id')->withTimestamps();
        return $this->belongsToMany('App\Topic', 'link_topics')->withTimestamps();
    }
    
    
    public function voteUp($link_id){
        DB::table('links')->where('id', $link_id)->increment('vote_up', 1);
    }
    
    public function voteDown($link_id){
        DB::table('links')->where('id', $link_id)->decrement('vote_up', 1);
    }
}
