<?php 
 
use Illuminate\Database\Seeder; 
use App\Sprint; 
 
class SprintsSeeder extends Seeder 
{ 
    /** 
     * Run the database seeds. 
     * 
     * @return void 
     */ 
    public function run() 
    { 
        $sprint1 = Sprint::create(['kode_sprint' => '1', 'nama_sprint' => 'Nama1', 'tanggal_mulai' => '2017-10-04']); 
	    $sprint2 = Sprint::create(['kode_sprint' => '2', 'nama_sprint' => 'Nama2', 'tanggal_mulai' => '2017-10-05']); 
	    $sprint3 = Sprint::create(['kode_sprint' => '3', 'nama_sprint' => 'Nama3', 'tanggal_mulai' => '2017-10-06']); 
    } 
} 