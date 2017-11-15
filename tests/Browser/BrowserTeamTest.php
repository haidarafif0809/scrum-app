<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Team;
use App\user;


class BrowserTeamTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */


    public function testBrowserTambahTeam()
    {
      $this->browse(function ($first) {
        $first->loginAs(User::find(1))
        ->visit('/admin/teams')
        ->clickLink("Tambah")
        ->type('kode_team', '395')
        ->type('nama_team', 'team7')
        ->press('.btn-primary')
        ->assertSee('Berhasil menyimpan team3');
    });
  }

}
