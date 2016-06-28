<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farm_owner_id');
            $table->string('cattle_sold_age')->nullable();
            $table->string('cattle_sold_weight')->nullable();
            $table->timestamps();

        });

        Schema::create('choice_community', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            $table->string('joined')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('communities');
        Schema::dropIfExists('choice_communities');
    }
}
