<?php

use Illuminate\Database\Seeder;
use App\Backlog;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersSeeder::class);
         $this->call(BacklogsSeeder::class);
    }
}
