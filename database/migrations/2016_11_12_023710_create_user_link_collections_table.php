<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLinkCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_link_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); // 用户id
            $table->integer('link_id'); // 被收藏德链接id
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
        Schema::drop('user_link_collections');
    }
}
