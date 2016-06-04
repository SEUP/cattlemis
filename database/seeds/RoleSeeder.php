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
        $admin->role = "Administrator";
        $admin->save();

        $user = new \App\Models\Role();
        $user->key = "user";
        $user->role = "User";
        $user->save();
    }
}
