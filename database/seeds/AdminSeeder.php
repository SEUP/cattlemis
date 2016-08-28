<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = \App\Models\Role::where('key', '=', 'admin')->first();

        $admin = new \App\Models\User();
        $admin->email = "admin@admin.local";
        $admin->password = \Illuminate\Support\Facades\Hash::make("admin");
        $admin->firstname = "Admin";
        $admin->lastname = "Cattle MIS";
        $admin->user_province = 0;
        $admin->user_amphur = 0;
        $admin->user_district = 0;
        $admin->save();

        $admin->roles()->save($adminRole);
    }
}