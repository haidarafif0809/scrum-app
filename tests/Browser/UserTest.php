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
    public function testTambahUser()
    {
     $this->browse(function ($first, $second){

        $first->loginAs(User::find(1))
        ->visit('/admin/users')
        ->clickLink('Tambah Member')
        ->type('name', 'khofiq')
        ->type('email', 'khofiq@gmail.com');
        $first->script("document.getElementById('otoritas').selectize.setValue('1');");
        $first->assertSee('admin');
        $first->script("document.getElementById('team_id').selectize.setValue('1');");
        $first->assertSee('team1')
        ->pause(1000);

        $first->press('Simpan')
        ->assertSee("Berhasil menyimpan user khofiq");

        //     //PRODUK LANGSUNG DIHAPUS
        // $first->waitFor('.js-confirm')
        // ->with('.table', function ($table) {
        //     $table->assertSee('khofiq')
        //                 //cari tombol hapus tbs item keluar dan scroll ke sana
        //     ->element('.btn-hapus-tbs')->getLocationOnScreenOnceScrolledIntoView();
        //                 //form hapus tbs item keluarnya di submit
        //     $table->element('.form-hapus-tbs')->submit();                      
        // })
        //         //untuk menclick tombol oke di alert dialog javascript untuk menghapus tbs item keluar
        // ->driver->switchTo()->alert()->accept();
    });
 }
 public function testEditTeam(){
    $user = User::select('id')->orderBy('id','DESC')->first();

    $this->browse(function($first)use($user){
        $first->with('.table-user',function($table)use($user){
            $table->assertSee("khofiq")
            ->press('#btnEdit-'.$user->id);
        })
        ->assertSee('Ubah Data Member')
        ->type('name', 'khoirul')
        ->type('email', 'khoirul@gmail.com');
        $first->script("document.getElementById('otoritas').selectize.setValue('1');");
        $first->assertSee('admin');
        $first->script("document.getElementById('team_id').selectize.setValue('1');");
        $first->assertSee('team1')
        ->pause(1000);

        $first->press('Simpan')
        ->assertSee("Anda Berhasil mengedit khoirul");
    });
}
}
