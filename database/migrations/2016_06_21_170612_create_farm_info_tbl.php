<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmInfoTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farm_record')->nullable();
            $table->integer('farm_exp')->nullable();
            $table->integer('farm_future')->nullable();
            $table->integer('farm_register')->nullable();
            $table->integer('farm_disease_check')->nullable();
            $table->integer('abortion')->nullable();
            $table->integer('tuberculosis')->nullable();
            $table->integer('foot_mouth_disease')->nullable();

        });

        Schema::create('farm_info_join', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farm_purpose')->nullable();
            $table->integer('total_expense_amount')->nullable();
            $table->integer('expense_type')->nullable();
            $table->integer('total_cattle_amount')->nullable();
            $table->integer('total_male_breeder_amount')->nullable();
            $table->integer('total_female_breeder_amount')->nullable();
            $table->integer('total_male_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_male_cattle_aged_under_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_under_six_amount')->nullable();
            $table->integer('breeding_type')->nullable();
            $table->integer('cattle_type')->nullable();
            $table->string('cattle_source')->nullable();
            $table->integer('cattle_amount')->nullable();
            $table->integer('cattle_price')->nullable();
            $table->integer('farm_owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_info');
        Schema::dropIfExists('farm_info_join');
    }
}
