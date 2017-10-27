<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Team;
use App\User;
use URL;

class CrudTeam extends TestCase
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

    //CRUD TESTING 
    public function testTeamCrud()
    {
    	// TAMBAH TEAM
    	$team = Team::create(["kode_team"=> "10","nama_team"=>"team bug"]);
    	$this->assertDatabaseHas('teams',[
    		'kode_team' => '10', 'nama_team' => 'team bug'
    	]);

    	// UPDATE TEAM
    	Team::find($team->id)->update(["kode_team" => "20", "nama_team" => "team andaglos"]);
    	$this->assertDatabaseHas('teams',[
    		'kode_team' => '20', 'nama_team' => 'team andaglos'
    	]);

    	// DELETE TEAM
        Team::destroy($team->id);
        $this->assertDatabaseMissing('teams', ['kode_team' => '20', 'nama_team' => 'team andaglos']);

  //       $hapus_team = Team::destroy($team->id);
		// $this->assertEquals('1', $hapus_team);

    }

    
}

