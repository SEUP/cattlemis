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
            $table->unsignedInteger('house_amphur')->nullable();
            $table->unsignedInteger('house_district')->nullable();
            $table->string('house_postcode')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('farm_name')->nullable();
            $table->unsignedInteger('farm_no')->nullable();
            $table->unsignedInteger('farm_moo')->nullable();
            $table->unsignedInteger('farm_province')->nullable();
            $table->unsignedInteger('farm_district')->nullable();
            $table->unsignedInteger('farm_amphur')->nullable();
            $table->unsignedInteger('farm_lat')->nullable();
            $table->unsignedInteger('farm_long')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedInteger('avg_cattle_income')->nullable();
            //part2
            $table->integer('total_master_breeding_types')->nullable();
            $table->integer('total_male_breeding_types')->nullable();
            $table->integer('total_female_breeding_types')->nullable();
            $table->integer('total_male_over_six_breeding_types')->nullable();
            $table->integer('total_female_over_six_breeding_types')->nullable();
            $table->integer('total_male_under_six_breeding_types')->nullable();
            $table->integer('total_female_under_six_breeding_types')->nullable();
            $table->integer('total_expense_amount')->nullable();
            $table->integer('drug_price')->nullable();
            $table->integer('food_price')->nullable();
            //$table->string('expense_remark')->nullable();
            $table->integer('expense_price')->nullable();
            //part3
            $table->integer('total_workers_amount')->nullable();
            $table->integer('family_workers_amount')->nullable();
            $table->integer('external_workers_amount')->nullable();
            $table->integer('total_own_lands')->nullable();
            $table->integer('total_use_lands')->nullable();
            //part4
            $table->integer('breeding_rate')->nullable();
            //part5
            $table->integer('total_budget')->nullable();
            //part6
           // $table->string('cattle_sold_age')->nullable();
            //$table->string('cattle_sold_weight')->nullable();
            //part8
            $table->string('problem')->nullable();
            $table->string('suggestion')->nullable();
            $table->timestamps();
        });

        Schema::create('choice_farm_owner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('farm_owner_id');
            $table->string('remark')->nullable();
            //part2 remark amount price source
            $table->integer('amount')->nullable();
            $table->string('source')->nullable();
            $table->integer('price')->nullable();
            //part3 area width height price amount
            $table->integer('area')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            //part4 remark price amount
            //part5 remark rate amount
            $table->integer('rate')->nullable();
            //part6 remark joined duration
            $table->string('joined')->nullable();
            //$table->string('duration')->nullable();
            $table->string('age_range_sale')->nullable();
            $table->string('price_range_sale')->nullable();
            //part7 none
            //part8 none
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
        Schema::dropIfExists('choice_farm_owner');
    }
}
