<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class testHTTPBacklog extends TestCase
{
  use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */

    // protected function setUp() {
    //     parent::setUp();
        // kode untuk menset base url nya jadi localhost
        //   karena kalau gak localhost jadi tidak bisa jalan testing http nya
        //  selalu responnya 404 
    //     URL::forceRootUrl('http://localhost');    
    // }


//CRUD TESTING
    // public function testBacklogCrud() {
      
    //   //TAMBAH BANK
    //     $bank = Bank::create(["nama_bank" => "BRI","atas_nama" => "Rindang Ramadhan","no_rek"=>"1234567890"]);
    // $this->assertDatabaseHas('banks', ["nama_bank" => "BRI","atas_nama" => "Rindang Ramadhan","no_rek"=>"1234567890"]);

    // //UPDATE BANK
    // Bank::find($bank->id)->update(["nama_bank" => "BCA", "atas_nama"=>"Afrizal Ansyah", "no_rek"=>"9876543210"]);
    // $this->assertDatabaseHas('banks', ["nama_bank" => "BCA", "atas_nama" => "Afrizal Ansyah", "no_rek" => "9876543210"]);

    // //DELETE BANK
    // $hapus_bank = Bank::destroy($bank->id);

    //     $bank = Bank::find($bank->id);
    //     $this->assertDatabaseMissing('banks', ["nama_bank" => "BCA", "atas_nama" => "Afrizal Ansyah", "no_rek" => "9876543210"]);

    // }


//HTTP TESTING
    //TAMBAH BANK
    public function testHTTPTambahBank() {

        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('backlog.store'), ["aplikasi_id" => "9","nama_backlog" => "backlog testing","demo"=>"demo testing", "catatan"=>"catatan testing"]);

        $response->assertStatus(302)
                 ->assertRedirect(route('backlog.index'));
        

        $response2 = $this->get($response->headers->get('location'))->assertSee('Aplikasi Scrum');

        $this->assertDatabaseHas("backlogs", ["aplikasi_id" => "9", "nama_backlog" => "backlog testing", "demo"=>"demo testing", "catatan" => "catatan testing"]);
    }
}
