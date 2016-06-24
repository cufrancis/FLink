<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_tags', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('link_id')->unsigned(); // 链接id
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index(); // 标签id
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::drop('link_tags');
    }
}
