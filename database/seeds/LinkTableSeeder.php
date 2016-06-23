<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    public function run()
    {
        //
        DB::table('links')->insert([
          [
            'title'  =>  '百度一下，你就知道',
            'url'  =>  'http://www.baidu.com',
            'content' =>  '俗称百毒，不过国内使用率比较高test',
            'user_id' =>  1,
            'topics'    =>  '1,2',
          ],
          [
            'title' =>  'Google',
            'url'  =>  'http://www.google.com',
            'content' =>  '全球最大的互联网公司，以搜索引擎起家',
            'user_id' =>  1,
            'topics'    =>  1,
          ],
        ]);
    }
}
