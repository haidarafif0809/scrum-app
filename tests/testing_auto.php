<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Bank;
use App\User;
use URL;

class BankTest extends TestCase
{

//HAPUS BANK
    public function testHTTPHapusBank(){
        $bank = Bank::create(["nama_bank" => "BCA TESTING", "atas_nama" => "Ahyadi", "no_rek" => "1237855463622"]);

       //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('bank.destroy',$bank->id), ['_method' => 'DELETE']);

       $response->assertStatus(302)
                 ->assertRedirect(route('bank.index'));
        
       $response2 = $this->get($response->headers->get('location'))->assertSee('Sukses : Bank Berhasil Dihapus');        
   }

   //HALAMAN MENU EDIT BANK
    public function testHTTPUpdateBank(){

       $bank = Bank::create(["nama_bank" => "Bank Lampung", "atas_nama" => "Maulana Pasa", "no_rek" => "15475398433265"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->get(route('bank.edit',$bank->id));

       $response->assertStatus(200)
                 ->assertSee('Edit Bank');

   
    }

   //PROSES EDIT BANK
    public function testHTTPEditBank(){
        
       $bank = Bank::create(["nama_bank" => "Bank Lampung", "atas_nama" => "Maulana Pasa", "no_rek" => "15475398433265"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('bank.update',$bank->id), ['_method' => 'PUT','nama_bank' => 'Bank Lampung Testing Update', 'atas_nama' => 'Pasa Maulana', 'no_rek' => '15186366591366', 'tampil_customer' => '1']);

       $response->assertStatus(302)
                 ->assertRedirect(route('bank.index'));

       $response2 = $this->get($response->headers->get('location'))->assertSee('Sukses : Berhasil Mengubah Bank "Bank Lampung Testing Update"');
    
    }

     }
