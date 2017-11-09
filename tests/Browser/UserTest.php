<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($first) {
            $first->loginAs(User::find(1))
            ->visit('/scrum_app_baru/public/admin/users')
            ->clickLink('TAMBAH MEMBER')
            ->type('name', 'khoirul')
            ->type('email', 'khoirul@gmail.com');
            $first->script("document.getElementById('pilih_produk').selectize.setValue('1');");
            $first->assertSee('B001 - KECAP ASIN ABC')
            ->pause(1000);

            // $first->press('Submit')
            // ->assertSee('SUKSES : BERHASIL MENAMBAH PRODUK "KECAP ASIN ABC"');

            // //PRODUK LANGSUNG DIHAPUS
            // $first->waitFor('.js-confirm')
            // ->with('.table', function ($table) {
            //     $table->assertSee('KECAP ASIN ABC')
            //             //cari tombol hapus tbs item keluar dan scroll ke sana
            //     ->element('.btn-hapus-tbs')->getLocationOnScreenOnceScrolledIntoView();
            //             //form hapus tbs item keluarnya di submit
            //     $table->element('.form-hapus-tbs')->submit();                      
            // })
            //     //untuk menclick tombol oke di alert dialog javascript untuk menghapus tbs item keluar
            // ->driver->switchTo()->alert()->accept();
        });
    }
}
