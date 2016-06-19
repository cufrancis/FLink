<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration
{
    /**
     * 话题表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic', function (Blueprint $table) {
            $table->increments('id')->unsiged();
            $table->string('name'); // 话题名称
            $table->string('name_lower'); // 话题名称小写，唯一索引
            $table->string('desc'); // 话题的描述
            $table->string('pic')->nullable(); // 话题图片
            $table->bigInteger('click_count')->unsiged()->default(0); // 话题点击次数
            $table->bigInteger('follower_count')->unsiged()->default(0); // 话题的关注者数量
            $table->bigInteger('link_count')->unsiged()->default(0); // 话题下的链接数量
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
        Schema::drop('topic');
    }
}
