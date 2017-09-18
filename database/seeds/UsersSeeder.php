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
        $admin->name = 'admin toko dasar';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('rahasiaku');
        $admin->save();
        $admin->attachRole($adminRole);

        // membuat sample member
		$member = new User;
        $member->name = 'member toko dasar';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('rahasiaku');
        $member->save();
        $member->attachRole($memberRole);


    }
}

