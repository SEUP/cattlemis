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
        Schema::create('farm_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('farm_owner_id');
            $table->integer('total_cattle_amount')->nullable();
            $table->integer('total_male_breeder_amount')->nullable();
            $table->integer('total_female_breeder_amount')->nullable();
            $table->integer('total_male_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_male_cattle_aged_under_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_under_six_amount')->nullable();
            $table->integer('total_expense_amount')->nullable();
            $table->integer('drug_price')->nullable();
            $table->integer('food_price')->nullable();
            $table->string('expense_remark')->nullable();
            $table->integer('expense_price')->nullable();
            $table->timestamps();

        });
        
        Schema::create('choice_farm_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            $table->integer('amount')->nullable();
            $table->string('source')->nullable();
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
        Schema::dropIfExists('farm_infos');
        Schema::dropIfExists('choice_farm_info');
    }
}