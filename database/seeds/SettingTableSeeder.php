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
            ['name' =>  'website_name', 'value'    =>  'findLink'],
            ['name' =>  'website_admin_email', 'value'  =>  'cufrancis.com@gmail.com'],
        ]);
    }
}
