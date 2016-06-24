<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExecuteThailandDbSql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(resource_path("assets/sql/thailand_db_chaow.sql")));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('thailand_amphures');
        Schema::drop('thailand_provinces');
        Schema::drop('thailand_districts');
        Schema::drop('thailand_zipcodes');
    }
}
