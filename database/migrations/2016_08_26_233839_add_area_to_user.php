<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('user_province')->nullable();
            $table->unsignedInteger('user_amphur')->nullable();
            $table->unsignedInteger('user_district')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_province')->nullable();
            $table->dropColumn('user_amphur')->nullable();
            $table->dropColumn('user_district')->nullable();

        });
    }
}
