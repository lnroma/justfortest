<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEavModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('backend_name');
            $table->string('frontend_name');
            $table->string('key');
            $table->string('backend_type');
            $table->string('frontend_type');
            $table->string('frontend_edit_type');
            $table->text('description')->nullable();
            $table->integer('show_in_frontend');
            $table->integer('show_in_anketa');
            $table->integer('filterable');
            $table->integer('show_in_filters');
            $table->integer('is_system');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_attribute_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('attribute_id');
            $table->string('value');
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
