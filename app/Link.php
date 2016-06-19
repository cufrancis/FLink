<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable=['title', 'url', 'user_id'];
    
    public function userInfo(){
      return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function voteUp($link_id){
        DB::table('links')->where('id', $link_id)->increment('vote_up', 1);
    }
    
    public function voteDown($link_id){
        DB::table('links')->where('id', $link_id)->decrement('vote_up', 1);
    }
}
