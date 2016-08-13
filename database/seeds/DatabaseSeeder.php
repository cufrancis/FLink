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
        if ( App::environment() == 'production' ){
            exit('这是生产环境！！不想干了？？');
        }
        $this->call(UserTableSeeder::class);
        $this->call(LinkTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(LinkTopicsTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(LinkTagsTableSeeder::class);
        $this->call(SettingTableSeeder::class);
    }
}
