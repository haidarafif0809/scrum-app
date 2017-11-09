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
            ->type('kode_team', '3')
            ->type('nama_team', 'team tester')
            ->press('.btn-primary')
            ->assertSee('Berhasil menyimpan team tester');
        });
    }

    public function testEditTeam(){
        $this->browse(function($first){
            $first->loginAs(User::find(1))
            ->visit('/admin/teams')
            ->whenAvailable('.js-confirm', function ($table){
                ;
            })
            ->with('.table-striped',function($table){
                $table->assertSee("1")
                ->press('.btn-primary');
            })
            ->assertSee('Ubah Team')
            ->type('kode_team', '2')
            ->type('nama_team', 'team tester baru')
            ->press('.btn-primary')
            ->assertSee('Berhasil Mengedit team tester baru');
        });
    }


    public function testHapusTeam(){
      $team = Team::select('id')->where('kode_team','team tester baru')->first();
      $this->browse(function ($first) use ($team) {
        $first->loginAs(User::find(1))
        ->visit('/admin/teams')
        ->whenAvailable('.js-confirm', function ($table) {
          ;
      })
        ->with('.table-striped', function ($table){
            $table->press('.btn-danger')
            ->assertDialogOpened('Apakah anda yakin akan menghapus team tester baru?');
        })->driver->switchTo()->alert()->accept();
        $first->assertSee('Team berhasil dihapus'); 

    });
  }
}