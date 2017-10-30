<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Aplication;
class TambahAplikasi extends TestCase
{
	use DatabaseTransactions;
    /**u
     * A basic test example.
     *
     * @return void
     */

    public function testAplikasiTambah() {

        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('aplikasi.store'), ["nama" => "Sepko100%", "kode" => "ora adee"]);

        $response->assertStatus(302)
                 ->assertRedirect(route('aplikasi.index'));
        

        $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil Menambahkan Sepko100%');

        $this->assertDatabaseHas("aplications",["nama" => "Sepko100%","kode" => "ora adee"]);

        } 

         //PROSES EDIT BANK
    public function testAplikasiEdit(){
        
       $aplikasiku = Aplication::create(["nama" => "Ahide", "kode" => "0098"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('aplikasi.update',$aplikasiku->id), ['_method' => 'PUT','nama' => 'Ahide', 'kode' => '0098']);

       $response->assertStatus(302)
                 ->assertRedirect(route('aplikasi.index'));

       $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil Mengubah Ahide');
    
    }


   //HALAMAN MENU EDIT BANK
    public function testAplikasiUpdate(){

       $aplikasi = Aplication::create(["nama" => "Ahyadi", "kode" => "0086"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->get(route('aplikasi.edit',$aplikasi->id));

       $response->assertStatus(200)
                ->assertSee('Ahyadi');
		}

   //HAPUS BANK
    public function testAplikasiHapus(){
        $bank = Aplication::create(["nama" => "galang", "kode" => "001"]);

       //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('aplikasi.destroy',$bank->id), ['_method' => 'DELETE']);

       $response->assertStatus(302)
                 ->assertRedirect(route('aplikasi.index'));
        
       $response2 = $this->get($response->headers->get('location'))->assertSee('Aplikasi berhasil dihapus');        
  

   } 

  
    }