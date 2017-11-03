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
        $sprint1 = Sprint::create(['kode_sprint' => '1', 'nama_sprint' => 'Nama1', 'nilai_sp' => '1', 'goal' => 'sukses', 'tanggal_mulai' => '2017-10-04', 'waktu_mulai' => '07:00', 'durasi' => '2 minggu', 'team_id' => 1]); 
	    $sprint2 = Sprint::create(['kode_sprint' => '2', 'nama_sprint' => 'Nama2', 'nilai_sp' => '2', 'goal' => 'berhasil','tanggal_mulai' => '2017-10-05', 'waktu_mulai' => '09:00', 'durasi' => '1 minggu', 'team_id' => 1]); 
	    $sprint3 = Sprint::create(['kode_sprint' => '3', 'nama_sprint' => 'Nama3', 'nilai_sp' => '1', 'goal' => 'tercapai','tanggal_mulai' => '2017-10-06', 'waktu_mulai' => '08:00', 'durasi' => '3 minggu', 'team_id' => 2]); 
    } 
} 