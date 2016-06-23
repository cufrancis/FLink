<?php

use Illuminate\Database\Seeder;

class TopicLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topic_link')->insert([
            [
                'topic_id'  =>  1,
                'link_id'   =>  1,
            ],
            [
                'topics_id' =>  2,
                'link_id'   =>  1,
            ],
        ]);
    }
}
