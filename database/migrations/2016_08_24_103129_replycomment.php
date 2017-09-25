<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Replycomment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('post_id');
            $table->integer('user_id');
            $table->integer('comment_id')->unique();
            $table->string('replyBody');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comment_replies');
    }
}
