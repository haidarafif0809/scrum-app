<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{

    public function run()
    {
        // membuat role admin
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "admin";
        $adminRole->save(); 

        // membuat role member
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "member";
        $memberRole->save(); 

        // membuat sample admin 
        $admin = new User;
        $admin->name = 'Admin Aplikasi Scrum';
        $admin->email = 'admin@gmail.com';
        $admin->password = 'rahasiaku';
        $admin->is_verified = 1;
        $admin->save();
        $admin->attachRole($adminRole);

        // membuat sample member
        $member = new User;
        $member->name = 'Member Aplikasi Scrum';
        $member->email = 'member@gmail.com';
        $member->password = 'rahasiaku';
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($memberRole);


    }
}

