<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Sprint;

class CrudSprint extends TestCase
{
   // use DatabaseTransactions;
    public function testExample()
    {
        $sprint = Sprint::create(["kode_sprint" => "1", "nama_sprint" => "nama1", "tanggal_mulai" => "2017-10-04", "durasi" => "2minggu", "waktu_mulai" => "07:00:00", "team_id" => "1"]);
		$this->seeInDatabase('sprints', [
		         'kode_sprint' => '1', 'nama_sprint' => 'nama1', 'tanggal_mulai' => '2017-10-04', 'durasi' => '2minggu', 'waktu_mulai' => '07:00:00', 'team_id' => '1'
		      ]);



		Sprint::find($sprint->id)->update(["kode_sprint" => "2", "nama_sprint" => "nama2", "tanggal_mulai" => "2017-10-05", "durasi" => "1minggu", "waktu_mulai" => "08:00:00", "team_id" => "2"]);
		$this->seeInDatabase('sprints', [
         "kode_sprint" => "2", "nama_sprint" => "nama2", "tanggal_mulai" => "2017-10-05", "durasi" => "1minggu", "waktu_mulai" => "08:00:00", "team_id" => "2"
      ]);
		
		$hapus_sprint = Sprint::destroy($sprint->id);
		$this->assertEquals('1',$hapus_sprint);
    }
}