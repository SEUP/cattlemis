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

        Schema::create('choice_farm_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            $table->integer('total_expense_amount')->nullable();
            $table->integer('total_cattle_amount')->nullable();
            $table->integer('total_male_breeder_amount')->nullable();
            $table->integer('total_female_breeder_amount')->nullable();
            $table->integer('total_male_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_over_six_amount')->nullable();
            $table->integer('total_male_cattle_aged_under_six_amount')->nullable();
            $table->integer('total_female_cattle_aged_under_six_amount')->nullable();
            $table->string('cattle_source')->nullable();
            $table->integer('cattle_amount')->nullable();
            $table->integer('cattle_price')->nullable();
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
        Schema::dropIfExists('choice_farm_info');
    }
}
