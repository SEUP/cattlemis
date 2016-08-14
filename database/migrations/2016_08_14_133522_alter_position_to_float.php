<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPositionToFloat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_owners', function (Blueprint $table) {
            $table->float('farm_lat')->change();
            $table->float('farm_long')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farm_owners', function (Blueprint $table) {
            $table->integer('farm_lat')->change();
            $table->integer('farm_long')->change();
        });
    }
}
