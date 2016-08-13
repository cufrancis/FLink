<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
          'email' =>  'admin@admin.com',
          'password'  =>  bcrypt('000000'),
          'permissions' =>  9,
          'created_at'  =>  Carbon::now(),
          'updated_at'  =>  Carbon::now(),
        ]);
    }
}
