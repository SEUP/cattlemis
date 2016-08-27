<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\Role();
        $admin->key = "admin";
        $admin->role = "ผู้ดูแลระบบ";
        $admin->save();

        $user = new \App\Models\Role();
        $user->key = "user_province";
        $user->role = "ผู้ใช้งานระดับจังหวัด";
        $user->save();

        $user = new \App\Models\Role();
        $user->key = "user_amphur";
        $user->role = "ผู้ใช้งานระดับอำเภอ";
        $user->save();

        $user = new \App\Models\Role();
        $user->key = "user_district";
        $user->role = "ผู้ใช้งานระดับตำบล";
        $user->save();

    }
}
