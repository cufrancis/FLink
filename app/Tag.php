<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 标签表
 */
class Tag extends Model
{
    public function links(){
        return $this->belongsToMany('App\Link', 'link_topics');
    }
}
