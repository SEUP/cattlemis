<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceOptToChoiceFarmOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choice_farm_owner', function (Blueprint $table) {
            $table->string('source_opt')->nullable()->after('source');
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
            $table->string('source_opt')->nullable();
        });
    }
}
