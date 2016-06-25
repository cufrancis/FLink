<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value'];
    public $timestamps = false;
    
    public function get($name, $default = '') {
        $setting = self::where('name', '=', $name)->first();
        if ($setting) return $setting->value; 
        return $default;
    }
}
