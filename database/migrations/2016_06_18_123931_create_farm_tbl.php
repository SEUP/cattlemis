<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('person_id');
            $table->string('house_no')->nullable();
            $table->string('house_moo')->nullable();
            $table->unsignedInteger('house_province')->nullable();
            $table->unsignedInteger('house_district')->nullable();
            $table->unsignedInteger('house_suburb')->nullable();
            $table->string('house_postcode')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('farm_name')->nullable();
            $table->unsignedInteger('farm_no')->nullable();
            $table->unsignedInteger('farm_moo')->nullable();
            $table->unsignedInteger('farm_province')->nullable();
            $table->unsignedInteger('farm_district')->nullable();
            $table->unsignedInteger('farm_suburb')->nullable();
            $table->unsignedInteger('farm_lat')->nullable();
            $table->unsignedInteger('farm_long')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedInteger('avg_cattle_income')->nullable();
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
        Schema::dropIfExists('farm_owners');
    }
}
