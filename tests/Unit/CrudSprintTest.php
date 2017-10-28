<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Sprint;
use App\User;
use URL;
class testHTTPSprint extends TestCase
{
	use DatabaseTransactions;
 
        public function testSprintCrud()
    {
    	// TAMBAH TEAM
    	$sprint = Sprint::create(["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
    	$this->assertDatabaseHas('sprints',[
    		"kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"
    	]);

    	// UPDATE TEAM
    	Sprint::find($sprint->id)->update(["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
    	$this->assertDatabaseHas('sprints',[
    		"kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"
    	]);

    	// DELETE TEAM
        Sprint::destroy($sprint->id);
        $this->assertDatabaseMissing('sprints', ['kode_sprint' => '7', 'nama_sprint' => 'sprint7', 'tanggal_mulai' => '2019-10-09', 'waktu_mulai' => '12:09', 'durasi' => '7minggu', 'team_id' => '2', 'sp_tersedia' => '8']);

    }

     public function testHTTPTambahSprint() {

        //login user -> admin
        $user = User::find(1);

        $sprint = $this->actingAs($user)->json('POST', route('sprints.store'), ["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);

        $sprint->assertStatus(302)
                 ->assertRedirect(route('sprints.index'));
        

        $sprint2 = $this->get($sprint->headers->get('location'))->assertSee('Berhasil menyimpan nama backlog');

        $this->assertDatabaseHas("sprints",["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
    }

    // EDIT TEAM
    public function testHTTPEditSprint(){
        $sprint = Sprint::create(["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
        // login User -> 
        $user=User::find(1);

        $sprint = $this->actingAs($user)->json('get',route('sprints.edit', $sprint->id));
        $sprint->assertStatus(200)
            ->assertSee('Ubah Sprint');

    }


    // UPDATE TEAM
    public function testHTTPUpdateSprint(){
        
       $sprint = Sprint::create(["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
        //login user -> admin
        $user = User::find(1);

       $sprint = $this->actingAs($user)->json('POST', route('sprints.update',$sprint->id), ['_method' => 'PUT', 'kode_sprint' => '7', 'nama_sprint' => 'sprint7', 'tanggal_mulai' => '2019-10-09', 'waktu_mulai' => '12:09', 'durasi' => '7minggu', 'team_id' => '2', 'sp_tersedia' => '8']);

       $sprint->assertStatus(302)
                 ->assertRedirect(route('sprints.index'));

       $sprint2 = $this->get($sprint->headers->get('location'))->assertSee('Berhasil Mengubah Sprint');
    
    }

   
    // HAPUS TEAM
    public function testHTTPHapusSprint(){
        $sprint=Sprint::create(["kode_sprint" => "7", "nama_sprint" => "sprint7", "tanggal_mulai" => "2019-10-09", "waktu_mulai" => "12:09", "durasi" => "7minggu", "team_id" => "2", "sp_tersedia" => "8"]);
        // login user -> admin
        $user = User::find(1);

        $sprint=$this->actingAs($user)->json('POST',route('sprints.destroy',3),['_method'=>'DELETE']);
        $sprint->assertStatus(302)
            ->assertRedirect(route('sprints.index'));

        $sprint2=$this->get($sprint->headers->get('location'))->assertSee('Team berhasil dihapus');

        $this->assertDatabaseMissing('sprints',['id' => 3]);
   } 
}