<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFor215And47 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('choices')->insert(
            array(
                'id' => '296',
                'choice' => 'อื่นๆ',
                'type' => 'vaccine_types',
                'has_text' => '1',
                'parent_id' => '202',
                'created_at' => '2016-06-24 04:36:33',
                'updated_at' => '2016-06-24 04:36:33',
                'order' => '0',
            )
        );
        DB::table('choices')->insert(
            array(
                'id' => '297',
                'choice' => 'มี',
                'type' => 'disease_other',
                'has_text' => '1',
                'parent_id' => null,
                'created_at' => '2016-06-24 04:36:33',
                'updated_at' => '2016-06-24 04:36:33',
                'order' => '0',
            )
        );
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
