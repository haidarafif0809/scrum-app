<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SprintsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSprint()
    {
        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('spint.store'), ["kode_sprint" => "1", "nama_sprint" => "nama1", "tanggal_mulai" => "2017/06/08", "team_id", => "4", "durasi" => "2minggu", "waktu_mulai"=>"08:00"]);

        $response->seeInDatabase(302)
                 ->seeItRedirect(route('sprints.index'));
        

        $response2 = $this->get($response->headers->get('location'))->assertSee('Sukses : Berhasil Menambah Bank "Data"');

        $this->assertDatabaseHas("sprints",["kode_sprint" => "1", "nama_sprint" => "nama1", "tanggal_mulai" => "2017/06/08", "team_id", => "4", "durasi" => "2minggu", "waktu_mulai"=>"08:00"]);
    }

    //HAPUS BANK
    public function testHTTPHapusBank(){
        $bank = Bank::create(["kode_sprint" => "1", "nama_sprint" => "nama1", "tanggal_mulai" => "2017/06/08", "team_id", => "4", "durasi" => "2minggu", "waktu_mulai"=>"08:00", ""=>"1"]);

       //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('sprints.destroy',$bank->id), ['_method' => 'DELETE']);

       $response->assertStatus(302)
                 ->assertRedirect(route('sprints.index'));
        
       $response2 = $this->get($response->headers->get('location'))->assertSee('Sukses : Bank Berhasil Dihapus');        
   }

   //HALAMAN MENU EDIT BANK
    public function testHTTPUpdateBank(){

       $bank = Bank::create(["kode_sprint" => "2", "nama_sprint" => "nama2", "tanggal_mulai" => "2017/06/04", "team_id", => "2", "durasi" => "3minggu", "waktu_mulai"=>"03:00"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->get(route('sprints.edit',$bank->id));

       $response->assertStatus(200)
                 ->assertSee('Edit Bank');

   
    }

   //PROSES EDIT BANK
    public function testHTTPEditBank(){
        
       $bank = Bank::create(["kode_sprint" => "2", "nama_sprint" => "nama2", "tanggal_mulai" => "2017/06/04", "team_id", => "2", "durasi" => "3minggu", "waktu_mulai"=>"03:00", ""=>"1"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('sprints.update',$bank->id), ['_method' => 'PUT',"kode_sprint" => "2", "nama_sprint" => "nama2", "tanggal_mulai" => "2017/06/04", "team_id", => "2", "durasi" => "3minggu", "waktu_mulai"=>"03:00", ""=>"1"]);

       $response->assertStatus(302)
                 ->assertRedirect(route('bank.index'));

       $response2 = $this->get($response->headers->get('location'))->assertSee('Sukses : Berhasil Mengubah Bank "Data"');
    
    }
    }
}
