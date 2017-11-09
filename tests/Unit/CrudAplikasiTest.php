<?php

namespace Tests\Unit;

use Tests\TestCase;
Use App\Aplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudAplikasiTest extends TestCase
{
	use DatabaseTransactions;

	public function testCrudAplikasi()
	{
    	//tambah
		$aplikasi = Aplication::create(['kode' => '111', 'nama' => 'Aplikasi Test Crud']);
		$this->assertDatabaseHas('aplications', ['kode' => '111', 'nama' => 'Aplikasi Test Crud']);

        //update
		Aplication::find($aplikasi->id)->update(['kode' => '222', 'nama' => 'Aplikasi Test Crud Sudah Diupdate']);
		$this->assertDatabaseHas('aplications', ['kode' => '222', 'nama' => 'Aplikasi Test Crud Sudah Diupdate']);

        //delete
		Aplication::destroy($aplikasi->id);
		$this->assertDatabaseMissing('aplications', ['kode' => '222', 'nama' => 'Aplikasi Test Crud Sudah Diupdate']);
	}
}
