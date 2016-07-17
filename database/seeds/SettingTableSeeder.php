<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            // 站点名称
            ['name' =>  'website_name', 'value'    =>  'findLink'],
             // 管理员电子邮箱
            ['name' =>  'website_admin_email', 'value'  =>  'cufrancis.com@gmail.com'],
             // 站点地址
            ['name' =>  'website_url', 'value'  =>  'http://localhost'],
            // 网站备案号
            ['name' =>  'website_icp', 'value' => ''],
            // 网站默认模板
            ['name' =>  'website_theme', 'value' => 'default'],
            // 缓存
            ['name' =>  'website_cache_time',   'value' => 1],
            ['name' =>  'website_header', 'value' => ''],
            ['name' =>  'website_footer', 'value' => ''],
            
            // 本地时间与服务器时间差
            ['name' => 'time_diff', 'value' =>  '0'],
            // 时区设置
            ['name' =>  'time_offset', 'value' => '8'],
            // 时间格式
            ['name' =>  'time_format', 'value'  =>  'H:i'],
            // 人性化时间格式
            ['name' => 'time_friendly', 'value' => '1'],
            
            // 日期格式
            ['name' =>  'date_format', 'value'  =>  'Y-m-d'],

        ]);
    }
}
