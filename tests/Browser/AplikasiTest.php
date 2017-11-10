<?php

namespace Tests\Browser;

use App\User;
use App\Backlog;
use App\Aplication;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AplikasiTest extends DuskTestCase
{
  public function testTambahAplikasi()
  {
   $this->browse(function ($browser) {
    $browser->loginAs(User::find(1))
    ->visit('/admin/aplikasi')
    ->clickLink('Tambah')
    ->type('kode', '11111')
    ->type('nama', 'Aplikasi Browser Test')
    ->press('Simpan')
    ->assertSee('Berhasil Menambahkan Aplikasi Browser Test');
});
}

public function testEditAplikasi()
{
  $aplikasi = Aplication::select('id')->orderBy('id','DESC')->first();

  $this->browse(function($browser)use($aplikasi){
    $browser->with('.table-striped',function($table)use($aplikasi){
      $table->assertSee("Aplikasi Browser Test")
      ->press('#btnEdit-'.$aplikasi->id);
  })
    ->assertSee('Ubah')
    ->type('kode', '22222')
    ->type('nama', 'Aplikasi Browser Test Diedit')
    ->press('Simpan')
    ->assertSee('Berhasil Mengubah Aplikasi Browser Test Diedit');
});
}

public function testHapusAplikasi(){

  $aplikasi = Aplication::select(['id', 'nama'])->orderBy('id', 'DESC')->first();
  $this->browse(function ($first)use($aplikasi){
    $first->whenAvailable('.js-confirm', function ($table) { 
      ;
  })
    ->with('.table-striped', function ($table) use($aplikasi){
      $table->assertSee(''.$aplikasi->nama.'')
      ->press('#btnHapus-'.$aplikasi->id)
      ->assertDialogOpened('Yakin mau menghapus '.$aplikasi->nama.'.?');
  })->driver->switchTo()->alert()->accept();

    $first->assertSee('Aplikasi berhasil dihapus');
});
}
}

////////////////////////////////////////////////////////////////
//                                                            //
//  YANG INI JADI, TAPI KATA MAS RAMA NGGAK SESUAI ATURAN     //
//                                                            //
////////////////////////////////////////////////////////////////
/*
public function testHapusAplikasi()
{
  $aplikasi = Aplication::select('id')->orderBy('id', 'DESC')->first();
  $this->browse(function($browser)use($aplikasi){
   $browser->waitFor('.js-confirm')
   ->with('.table-striped', function($table)use($aplikasi){
    $table->assertSee('Aplikasi Browser Test Diedit');
    $table->element('#btnHapus-'.$aplikasi->id)->getLocationOnScreenOnceScrolledIntoView();
    $table->element('.form-hapus-aplikasi')->submit();
  })
   ->pause(2000)
   ->driver->switchTo()->alert()->accept();
   $browser->assertSee('Aplikasi');
 });
}*/


