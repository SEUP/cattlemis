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
        Schema::dropIfExists('thailand_amphures');
        Schema::dropIfExists('thailand_provinces');
        Schema::dropIfExists('thailand_districts');
        Schema::dropIfExists('thailand_zipcodes');
    }
}
