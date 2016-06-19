<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicLinkTable extends Migration
{
    /**
     * 标签与链接表关联
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_link', function (Blueprint $table) {
            $table->bigInteger('topic_id')->unsiged()->default(0)->index(); // 标签id
            $table->bigInteger('link_id')->unsiged()->default(0)->index(); // 链接id
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topic_link');
    }
}
