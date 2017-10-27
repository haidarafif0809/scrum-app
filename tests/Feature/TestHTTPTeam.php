<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Team;
use App\User;
use URL;

class testHTTPTeam extends TestCase
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

    //HTTP TESTING
    //TAMBAH Team
    public function testHTTPTambahTeam() {

        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('teams.store'), ["kode_team" => "10","nama_team" => "Team Bug"]);

        $response->assertStatus(302)
                 ->assertRedirect(route('teams.index'));
        

        $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil menyimpan Team Bug');

        $this->assertDatabaseHas("teams",["kode_team" => "10","nama_team" => "Team Bug",]);
    }



    // EDIT TEAM
    public function testHTTPEditTeam(){
        $team=Team::create(["kode_team" => "10", "nama_team" => "Team Andaglos"]);
        // login User -> 
        $user=User::find(1);

        $response = $this->actingAs($user)->json('get',route('teams.edit', $team->id));
        $response->assertStatus(200)
            ->assertSee('Team Andaglos');

    }


    // UPDATE TEAM
    public function testHTTPUpdateTeam(){
        
       $team = Team::create(["kode_team" => "134", "nama_team" => "Team Andaglos"]);
        //login user -> admin
        $user = User::find(1);

       $response = $this->actingAs($user)->json('POST', route('teams.update',$team->id), ['_method' => 'PUT','kode_team' => '134', 'nama_team' => 'Team']);

       $response->assertStatus(302)
                 ->assertRedirect(route('teams.index'));

       $response2 = $this->get($response->headers->get('location'))->assertSee('Berhasil Mengedit Team');
    
    }

   
    // HAPUS TEAM
    public function testHTTPHapusTeam(){
        $team=Team::create(["kode_team" => "10","nama_team" => "Team"]);
        // login user -> admin
        $user = User::find(1);

        $response=$this->actingAs($user)->json('POST',route('teams.destroy',3),['_method'=>'DELETE']);
        $response->assertStatus(302)
            ->assertRedirect(route('teams.index'));

        $response2=$this->get($response->headers->get('location'))->assertSee('Team berhasil dihapus');

        $this->assertDatabaseMissing('teams',['id' => 3]);
   }
}
