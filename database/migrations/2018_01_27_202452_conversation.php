<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conversation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create table conversation
        Schema::create('user_conversation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('one_user'); // get id conversation for get messages
            $table->integer('two_user'); // get id conversation for get messages
            $table->timestamps();
            $table->softDeletes();
        });

        // create table messages
        Schema::create('user_conversation_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_id');
            $table->integer('user_from');
            $table->integer('user_to');
            $table->integer('is_read');
            $table->text('message');
            $table->timestamps();
            $table->softDeletes();
        });

        // create table black list
        Schema::create('user_block_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from');
            $table->integer('user_to');
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
        //
    }
}
