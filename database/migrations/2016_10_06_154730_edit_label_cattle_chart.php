<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLabelCattleChart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 54");
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 64");
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 74");
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 84");
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 94");
        DB::update("UPDATE `choices` SET `choice` = 'พันธุ์ลูกผสม' WHERE `choices`.`id` = 104");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
