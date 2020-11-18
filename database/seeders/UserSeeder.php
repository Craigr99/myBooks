<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get user roles where name column = ?
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        // Admin user
        $admin = new User();
        $admin->f_name = 'Craig';
        $admin->l_name = 'Redmond';
        $admin->email = 'admin@example.com';
        $admin->username = 'craigr1';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        // Regular user
        $user = new User();
        $user->f_name = 'John';
        $user->l_name = 'Jones';
        $user->email = 'user@example.com';
        $user->username = 'username1';
        $user->password = Hash::make('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
