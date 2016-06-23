<?php

use Overtrue\Pinyin\Pinyin;
use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pinyin = new Pinyin();
        DB::table('topics')->insert([
            [
                'name' =>  '网站',
                'desc'  =>  '值得分享的网站',
                'name_lower'    =>  $pinyin->permalink('网站'),
            ],
            [
                'name'  =>  'Technology',
                'desc'  =>  '技术',
                'name_lower'    =>  $pinyin->permalink(strtolower('Technology')),
            ]
        ]);
    }
}
