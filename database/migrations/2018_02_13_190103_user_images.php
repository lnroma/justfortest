<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_image_gallery_directory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
        //
        Schema::create('user_image_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_image_gallery_directory_id');
            $table->string('user_image_gallery_directory_key')->nullable();
            $table->integer('user_id');
            $table->string('filename');
            $table->string('cdn_key');
            $table->string('name')->nullb;
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_image_gallery_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title')->nullable();
            $table->text('text');
            $table->timestamps();
            $table->softDeletes();
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
