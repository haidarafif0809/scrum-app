<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Aplication;
class TestHTTPAplikasi extends TestCase
{
	use DatabaseTransactions;
    /**u
     * A basic test example.
     *
     * @return void
     */

    public function testHTTPAplikasi() {

        //login user -> admin
      $user = User::find(1);

      $response = $this->actingAs($user)->json('POST', route('aplikasi.store'), ["nama" => "AplikasiTest", "kode" => "04"]);

      $response->assertStatus(302)
      ->assertRedirect(route('aplikasi.index'));


      $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil Menambahkan AplikasiTest');

      $this->assertDatabaseHas("aplications",["nama" => "AplikasiTest","kode" => "04"]);

    } 


   //HALAMAN MENU EDIT APLIKASI
    public function testAplikasiEdit(){

      $aplikasi = Aplication::create(["nama" => "AplikasiHttp", "kode" => "05"]);
        //login user -> admin
      $user = User::find(1);

      $response = $this->actingAs($user)->get(route('aplikasi.edit',$aplikasi->id));

      $response->assertStatus(200)
      ->assertSee('AplikasiHttp');
    }
     //PROSES EDIT APLIKASI
    public function testAplikasiUpdate(){

     $aplikasi = Aplication::create(["nama" => "AplikasiTest", "kode" => "05"]);
        //login user -> admin
     $user = User::find(1);

     $response = $this->actingAs($user)->json('POST', route('aplikasi.update',$aplikasi->id), ['_method' => 'PUT','nama' => 'AplikasiHttp', 'kode' => '05']);

     $response->assertStatus(302)
     ->assertRedirect(route('aplikasi.index'));

     $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil Mengubah AplikasiHttp');

   }
   //HAPUS APLIKASI
   public function testAplikasiHapus(){
    $aplikasi = Aplication::create(["nama" => "AplikasiHttp", "kode" => "05"]);

       //login user -> admin
    $user = User::find(1);

    $response = $this->actingAs($user)->json('POST', route('aplikasi.destroy',$aplikasi->id), ['_method' => 'DELETE']);

    $response->assertStatus(302)
    ->assertRedirect(route('aplikasi.index'));

    $response2 = $this->get($response->headers->get('location'))->assertSee('Aplikasi berhasil dihapus');        


  } 

  
}