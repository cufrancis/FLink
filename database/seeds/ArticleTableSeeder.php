<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->insert([
          [
            'title'  =>  '百度一下，你就知道',
            'link'  =>  'http://www.baidu.com',
            'content' =>  '俗称百毒，不过国内使用率比较高',
            'author_id' =>  1,
          ],
          [
            'title' =>  'Google',
            'link'  =>  'http://www.google.com',
            'content' =>  '全球最大的互联网公司，以搜索引擎起家',
            'author_id' =>  1,
          ],
        ]);
    }
}
