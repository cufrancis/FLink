<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 128)->unique();
            $table->string('mobile', 24)->index()->nullable();
            $table->string('password');
            $table->tinyInteger('gender')->nullable(); // 性别，0 女， 1 男 2 保密
            $table->date('birthday')->nullable(); // 生日
            $table->string('desc')->nullable()->default('系统报了个错，召唤我来到了这里 <(▰˘◡˘▰)>'); //个人简介
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
