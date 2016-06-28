<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farm_owner_id');
            $table->integer('workers_amount')->nullable();;
            $table->integer('family_workers_amount')->nullable();;
            $table->integer('external_workers_amount')->nullable();;
            $table->integer('total_own_lands')->nullable();;
            $table->integer('total_use_lands')->nullable();;
            $table->timestamps();

        });

        Schema::create('choice_worker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            $table->integer('area')->nullable();
            $table->integer('price')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('amount')->nullable();
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
        Schema::dropIfExists('workers');
        Schema::dropIfExists('choice_workers');
    }
}
