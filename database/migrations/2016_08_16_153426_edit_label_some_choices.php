<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLabelSomeChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update("UPDATE `choices` SET `choice` = 'ขายเพื่อเป็นรายได้จำนวน' WHERE `choices`.`id` = 206");
        DB::update("UPDATE `choices` SET `choice` = 'ใช้เงินทุนของตัวเอง' WHERE `choices`.`id` = 211");
        DB::update("UPDATE `choices` SET `choice` = 'เงินกู้จากธนาคารพาณิชย์' WHERE `choices`.`id` = 215");
        DB::update("UPDATE `choices` SET `choice` = 'เงินทุนกู้จากกองทุนหมู่บ้าน' WHERE `choices`.`id` = 216");
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
