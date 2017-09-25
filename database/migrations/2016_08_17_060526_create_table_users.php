<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    public function up()
    {
        Schema::create('users',function (Blueprint $table){
           $table->increments('id');
           $table->timestamps();
           $table->string('email');
           $table->string('fullname');
            $table->string('password');
            $table->integer('emailverified')->default(0);
           $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
