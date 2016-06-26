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
            $table->integer('worker_amount');
            $table->integer('family_worker_amount');
            $table->integer('external_worker_amount');
            $table->integer('total_own_land');
            $table->integer('total_rent_land');
            $table->timestamps();

        });

        Schema::create('choice_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            $table->integer('area')->nullable();
            $table->integer('price')->nullable();
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
