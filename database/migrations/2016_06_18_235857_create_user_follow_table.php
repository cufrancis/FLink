<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowTable extends Migration
{
    /**
     * 用户跟随表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_follow', function (Blueprint $table) {
            // $table->increments('id');
            $table->bigInteger('user_id')->unsiged()->default(0)->index(); // 跟随者的id
            $table->bigInteger('follow_id')->unsiged()->default(0)->index(); // 被跟随者的id
            $table->timestamp('create_time'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_follow');
    }
}
