<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Team;
use App\User;

class TeamTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTambahTeam()
    {
      $this->browse(function ($first) {
        $first->loginAs(User::find(1))
        ->visit('/admin/teams')
        ->clickLink("Tambah")
        ->type('kode_team', '3555')
        ->type('nama_team', 'team3')
        ->press('.btn-primary')
        ->assertSee('Berhasil menyimpan team3');
      });

    } public function testUniqueTeam()
    {
      $this->browse(function ($first) {
        $first->loginAs(User::find(1))
        ->visit('/admin/teams')
        ->clickLink("Tambah")
        ->type('kode_team', '3555')
        ->type('nama_team', 'team3')
        ->press('.btn-primary');
        $first->assertSee('Data kode team sudah terpakai.');
        $first->assertSee('Data nama team sudah terpakai.');
        
      });
    }

    public function testEditTeam(){
      $team = Team::select('id')->orderBy('id','DESC')->first();

      $this->browse(function($first)use($team){
        $first
        ->visit('/admin/teams')
        ->with('.table-striped',function($table)use($team){
          $table->assertSee("team3")
          ->press('#btnEdit-'.$team->id);
        })
        ->assertSee('Ubah Team')
        ->type('kode_team', '44442')
        ->type('nama_team', 'team4')
        ->press('Simpan')
        ->assertSee('Berhasil Mengedit team4');
      });
    }


    public function testHapusTeam(){
      $team = Team::select(['id','nama_team'])->orderBy('id','DESC')->first();
      $this->browse(function ($first) use ($team) {
        $first->whenAvailable('.js-confirm', function ($table) {
          ;
        })
        ->with('.table-striped', function ($table)use($team){
          $table->assertSee(''.$team->nama_team.'')
          ->press('#btnHapus-'.$team->id)
          ->assertDialogOpened('Apakah anda yakin akan menghapus team4?');
        })->driver->switchTo()->alert()->accept();
        $first->assertSee('Team berhasil dihapus'); 

      });
    }
  }