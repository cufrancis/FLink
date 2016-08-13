<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $fillable=['title', 'link', 'content', 'author_id'];

  public function authorInfo(){
    return $this->hasOne('App\Model\User', 'id', 'author_id');
  }
}
