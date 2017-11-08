<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class BacklogTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //                 ->assertSee('Laravel');
    //     });
    // }
    public function testTambahBacklog() {
        $this->browse(function ($first, $second){

            $first->loginAs(User::find(1))
            ->visit('/backlog')
            ->clickLink('Tambah');
            
            $first->script("document.getElementById('aplikasi_id').selectize.setValue('1');");
            $first->assertSee('Aplikasi Absen Siswa')
            ->type('nama_backlog', 'Backlog Testing')
            ->type('demo', 'Testing demo untuk backlog testing')
            ->type('catatan', 'Testing catatan untuk backlog testing')
            ->pause(1000);

            $first->press('Simpan')
            ->assertSee('Berhasil menyimpan "Backlog Testing" !');
        });
    }
}
