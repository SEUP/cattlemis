<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('choice');
            $table->string('type');
            $table->boolean('has_text');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('choice_farmowner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farmowner_id');
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
        Schema::drop('choices');
    }
}

