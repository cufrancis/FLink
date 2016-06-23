<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(LinkTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(TopicLinkTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(LinkTagsTableSeeder::class);
    }
}
