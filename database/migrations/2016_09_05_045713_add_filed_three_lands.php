<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledThreeLands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_owners', function (Blueprint $table) {
            $table->unsignedInteger('total_own_lands_sub')->nullable();
            $table->unsignedInteger('total_use_lands_sub')->nullable();
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
            $table->dropColumn('total_own_lands_sub')->nullable();
            $table->dropColumn('total_use_lands_sub')->nullable();
        });
    }
}
