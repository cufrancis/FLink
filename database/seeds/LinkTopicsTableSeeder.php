<?php

use Illuminate\Database\Seeder;

class LinkTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link_topics')->insert([
            ['link_id'  =>  1, 'topic_id' =>  1],
            ['link_id'  =>  1, 'topic_id' =>  2],
            ['link_id'  =>  2, 'topic_id' =>  3],
        ]);
    }
}
