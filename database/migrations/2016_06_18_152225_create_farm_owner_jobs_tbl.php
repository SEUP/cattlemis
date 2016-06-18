<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmOwnerJobsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_owners_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jobtype');
            $table->string('tumsuantype')->nullable();
            $table->string('tumraitype')->nullable();
            $table->string('other')->nullable();
            //$table->integer('house_no');
            $table->unsignedInteger('farm_owner_id');
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
        Schema::dropIfExists('farm_owners_jobs');
    }
}
