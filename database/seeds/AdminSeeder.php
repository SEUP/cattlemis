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
        $admin->email = "admin@chaow.local";
        $admin->password = \Illuminate\Support\Facades\Hash::make("admin");
        $admin->firstname = "Chaow";
        $admin->lastname = "Porkaew";
        $admin->save();

        $admin->roles()->save($adminRole);
    }
}