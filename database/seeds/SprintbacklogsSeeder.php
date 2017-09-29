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
        $backlog1 = Sprintbacklog::create(['backlog' => '1',   'isi_kepentingan' => 'data1', 'perkiraan_waktu' => '100']); 
        $backlog1 = Sprintbacklog::create(['backlog' => '1', 'isi_kepentingan' => 'data2', 'perkiraan_waktu' => '101']); 
    } 
} 