<?php 

use Illuminate\Database\Seeder; 
use App\Sprintbacklog; 

class SprintbacklogsSeeder extends Seeder 
{ 
    /** 
     * Run the database seeds. 
     * 
     * @return void 
     */ 
    public function run() 
    {
    	$sprintBacklog1 = Sprintbacklog::create(['isi_kepentingan' => 32, 'perkiraan_waktu' => 3, 'id_sprint' => 1, 'id_backlog' => 1, 'assign' => 0, 'assign_user_id' => 0]);
    	$sprintBacklog2 = Sprintbacklog::create(['isi_kepentingan' => 34, 'perkiraan_waktu' => 2, 'id_sprint' => 1, 'id_backlog' => 2, 'assign' => 0, 'assign_user_id' => 0]);
    	$sprintBacklog3 = Sprintbacklog::create(['isi_kepentingan' => 35, 'perkiraan_waktu' => 3, 'id_sprint' => 1, 'id_backlog' => 3, 'assign' => 0, 'assign_user_id' => 0]);

    } 
} 