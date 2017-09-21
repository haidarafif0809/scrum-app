<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // sample team
        $teams1 = Team::create(['kode_team'=>01, 'nama_team'=>'team1']);
        $teams2 = Team::create(['kode_team'=>02, 'nama_team'=>'team2']);
    }
}
