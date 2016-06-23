<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable=['title', 'url', 'user_id'];
    
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
    public function topicsInfo(){
        
        // 第一个参数是我们最终希望访问的模型的名称，第二个参数是中间模型的名称
        // 第三个参数是中间模型的外键名，第四个参数是最终模型的外键名
        return $this->belongsToMany('App\Topics', 'link_topics', 'link_id', 'topic_id');
    }
    
    public function tagsInfo(){
        return $this->belongsToMany('App\Tag', 'link_tags', 'link_id', 'tag_id');
    }
    
    
    public function voteUp($link_id){
        DB::table('links')->where('id', $link_id)->increment('vote_up', 1);
    }
    
    public function voteDown($link_id){
        DB::table('links')->where('id', $link_id)->decrement('vote_up', 1);
    }
}
