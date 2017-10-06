<?php

use Illuminate\Database\Seeder;
use App\TeamUser;

class TeamUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// sample teamUseer
        $teamUserSeeder1 = TeamUser::create(['user_id' => 1, 'team_id' => 1]);
        $teamUserSeeder2 = TeamUser::create(['user_id' => 2, 'team_id' => 2]);
    }
}
