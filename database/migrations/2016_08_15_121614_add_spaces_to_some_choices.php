<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpacesToSomeChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        UPDATE `choices` SET `choice` = 'ใช้การผสมเทียม (ตอบข้อ 4.2)' WHERE `choices`.`id` = 174
//        UPDATE `choices` SET `choice` = 'ใช้พ่อพันธุ์คุมฝูง (ตอบข้อ 4.3)' WHERE `choices`.`id` = 175
//        UPDATE `choices` SET `choice` = 'ใช้ทั้งการผสมเทียมและพ่อพันธุ์คุมฝูง (ตอบทั้งข้อ 4.3)' WHERE `choices`.`id` = 176

        DB::update("UPDATE `choices` SET `choice` = 'ใช้การผสมเทียม (ตอบข้อ 4.2)' WHERE `choices`.`id` = 174");
        DB::update("UPDATE `choices` SET `choice` = 'ใช้พ่อพันธุ์คุมฝูง (ตอบข้อ 4.3)' WHERE `choices`.`id` = 175");
        DB::update("UPDATE `choices` SET `choice` = 'ใช้ทั้งการผสมเทียมและพ่อพันธุ์คุมฝูง (ตอบทั้งข้อ 4.3)' WHERE `choices`.`id` = 176");

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
