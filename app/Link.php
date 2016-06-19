<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable=['title', 'url', 'user_id'];
    
    public function authorInfo(){
      return $this->hasOne('App\User', 'id', 'user_id');
    }
}
