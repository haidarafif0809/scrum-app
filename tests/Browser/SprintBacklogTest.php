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
            ->visit('/sprintbacklogs')
                    ->clickLink('Tambah SprintBacklog')
                    ->type('nama_backlog', 'aplikasi')
                    ->type('isi_kepentingan', '600')
                    ->type('perkiraan_waktu', '5')
                    ->type('asign', 'dinata');
                        $browser->element('#btnSubmit')->submit();
                    $browser->assertSeeLink('Tambah SprintBacklog');
        });
    }
}
