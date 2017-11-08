<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Aplication;


class AplikasiTest extends DuskTestCase
{

    public function testTambahAplikasi()
    {
       $this->browse(function ($browser) {
        $browser->loginAs(User::find(1))
        ->visit('/admin/aplikasi')
        ->clickLink('Tambah')
        ->type('kode', '12')
        ->type('nama', 'Aplikasi Browser Test')
        ->pause(1500)
        ->press('Simpan')
        ->assertSee('Berhasil Menambahkan');
    });
   }

}


