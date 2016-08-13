<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value'];
    public $timestamps = false;

    /**
     * 查询某个配置信息
     * @param  [type] $name    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public function get($name, $default = '') {
        $setting = self::where('name', '=', $name)->first();
        if ($setting) return $setting->value;
        return $default;
    }

    /**
     * 设置配置信息，如果不存在就创建新字段
     * @param [type] $name  [description]
     * @param [type] $value [description]
     */
    public function set($name, $value) {
        self::updateOrCreate(['name' => $name], ['value' => $value]);
    }

    /**
     * 清除配置缓存信息
     * @return [type] [description]
     */
    public function clearAll() {

    }
}
