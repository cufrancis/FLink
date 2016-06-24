<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_topics', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('link_id')->unsigned()->index(); // 链接id
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->integer('topic_id')->unsigned()->index(); // 标签id
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
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
        Schema::drop('link_topics');
    }
}
