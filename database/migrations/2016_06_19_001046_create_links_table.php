<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * 分享链接表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index(); // 用户id
            $table->integer('status')->default(0); // 链接的状态(0:正常， 3 删除)
            // $table->integer('content_type')->default(0); // 内容类型
            // $table->timestamp('create_time')->index(); // 创建时间
            $table->integer('vote_up')->default(0); // 顶的数量
            $table->integer('vote_down')->default(0); // 踩的数量
            $table->decimal('reddit_score', 28, 10); // 链接得分
            $table->integer('views')->unsigned()->default(0); // 查看数量
            $table->integer('comment_count')->unsigned()->default(0); // 链接总评论数
            $table->integer('collections')->unsigned()->default(0); // 收藏数
            $table->string('topics')->default(''); // 标签，以分号隔开
            $table->string('title'); // 链接标题
            $table->string('url'); // 超链接
            $table->string('content')->default(""); // 链接内容
            $table->timestamps();
            $table->timestamp('published_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}
