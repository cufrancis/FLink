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
            $table->string('name')->index();
            $table->string('email', 128)->unique();
            $table->string('mobile', 24)->index()->nullable();
            $table->string('password');
            $table->tinyInteger('gender')->nullable(); // 性别，0 女， 1 男 2 保密
            $table->date('birthday')->nullable(); // 生日
            $table->string('user_pic')->nullable(); // 用户头像
            $table->integer('link_count')->default(0); // 用户分享的链接数量
            $table->integer('friend_count')->default(0); // 关注的数量
            $table->integer('follower_count')->default(0); // 粉丝的数量
            $table->bigInteger('last_read_link_id')->default(0); // 最后阅读的最新链接的链接id
            $table->bigInteger('last_read_friend_link_id')->default(0); // 最后阅读的关注好友的最新链接的链接id
            $table->integer('status')->default(0); // 用户状态，0 正常，1 锁定， 2 禁言 3 删除
            
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
