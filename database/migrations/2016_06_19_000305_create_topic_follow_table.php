<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicFollowTable extends Migration
{
    /**
     * 用户关注的话题
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topcic_follow', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsiged()->default(0)->index(); // 用户的id
            $table->bigInteger('topic_id')->unsiged()->default(0)->index(); // topic的id
            $table->timestamp('create_time'); // 关注的时刻
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topcic_follow');
    }
}
