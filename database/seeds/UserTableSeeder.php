<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
          'name'  =>  'cufrancis',
          'email' =>  'cufrancis@163.com',
          'password'  =>  bcrypt('041000lxj'),
          'permissions' =>  9,
        ]);
    }
}
