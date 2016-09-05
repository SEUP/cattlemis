<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSubArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choice_farm_owner', function (Blueprint $table) {
            $table->unsignedInteger('subarea')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choice_farm_owner', function (Blueprint $table) {
            $table->dropColumn('subarea')->nullable();
        });
    }
}
