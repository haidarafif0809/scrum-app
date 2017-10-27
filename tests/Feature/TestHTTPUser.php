<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\RoleUser;
use App\TeamUser;
use URL;

class TestHTTPUser extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
      protected function setUp() {
        parent::setUp();
        // kode untuk menset base url nya jadi localhost
        //   karena kalau gak localhost jadi tidak bisa jalan testing http nya
        //  selalu responnya 404 
        URL::forceRootUrl('http://localhost');    
    }
    // proses tambah user
    public function testHTTPTambahUser()
    {
    	// Role Login
    	$user = User::find(1);

    	$response = $this->actingAs($user)->json('POST', route('users.store'), [
    		"name" => "khoirul", 
    		"email" => "khoirul@gmail.com",
    		"password" => "rahasiaku", 
    		"is_verified" => "1",
    		"otoritas" => "1",
    		"team_id" => array('0' =>1, '1' =>2)
    	]);

    	$response->assertStatus(302)
    	->assertRedirect(route('users.index'));

    	$this->get($response->headers->get('location'))->assertSee("<p>Berhasil menyimpan user khoirul</p>");
    	// table User
    	$this->assertDatabaseHas('users', [
    		"name" => "khoirul",
    		"email" => "khoirul@gmail.com",
    		"is_verified" => "1"
    	]);
    	//  table role_user
    	$this->assertDatabaseHas('role_user', [
    		"role_id" => "1"
    	]);
    	// table team_users
    	$this->assertDatabaseHas('team_users', [
    		"team_id" => array('0' => 1, '1' => 2 )
    	]);
    }

    // halaman edit user
    public function testHTTPEditUser() {
    	$user = User::find(1);

    	$response = $this->actingAs($user)->get(route('users.edit', $user->id));
    	$response->assertStatus(200)
    	->assertSee("Ubah Data Member");
    }

    // proses update user
    public function testHTTPUpdateUser(){
        
       $users = User::create([
          "name" => "khoirul",
          "email" => "khoirul@gmail.com",
          "password" => "rahasiaku",
          "is_verified" => "1"
       ]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('users.update',$users->id), [
          '_method' => 'PUT',
          "name" => "irul",
          "email" => "irul@gmail.com",
          "password" => "rahasiaku",
          "is_verified" => "1",
          "otoritas"=>"2",
          "team_id"=> array('0' =>1,'1'=>2)
        ]);

       $response->assertStatus(302)
                 ->assertRedirect(route('users.index'));

       $response2 = $this->get($response->headers->get('location'))->assertSee("Anda Berhasil mengedit irul !");
    
    }
    //PROOSES HAPUS USER
    public function testHTTPUser()
    {
    	//HAPUS BANK
        $users = User::create([
          "name" => "khoirul",
          "email" => "khoirul@gmail.com",
          "password" => "rahasiaku",
          "is_verified" => "1"
        ]);

       //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('users.destroy',$users->id), ['_method' => 'DELETE']);

       $response->assertStatus(302)
                 ->assertRedirect(route('users.index'));
        
       $response2 = $this->get($response->headers->get('location'))->assertSee("Proses menghapus berhasil !");        
   }

}
