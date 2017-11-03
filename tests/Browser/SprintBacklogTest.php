<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
class SprintBacklogTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ( $browser) {
            $browser->loginAs(User::find(1))
            ->visit('/sprints')
                    ->clickLink('Tambah');
                     $browser->type('tanggal_mulai', '2017/09/09');
                    $browser->type('waktu_mulai', '09:00');
                    $browser->type('kode_sprint', '7')
                    ->type('nama_sprint', 'namaa11')
                    ->type('nilai_sp', '76')
                    ->type('goal', 'suksess');
                    $browser->script("document.getElementById('team_id').selectize.setValue('2');");
                    $browser->assertSee("team2");
                    $browser->script("document.getElementById('durasi').selectize.setValue('2 Minggu');");
                    $browser->assertSee("2 Minggu");
                        $browser->element('Simpan')->submit();
                    $browser->assertSeeLink('Tambah');
        });
    }
}
