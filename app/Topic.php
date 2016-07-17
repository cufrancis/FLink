<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['name', 'desc'];
    
    public function links(){
        return $this->belongsToMany('App\Link', 'link_topics');
    }
}
