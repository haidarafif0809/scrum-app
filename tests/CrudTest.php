<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Mahasiswa;

class CrudTest extends TestCase
{
	
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $mahasiswa = Mahasiswa::create(["nama_mahasiswa" => "Afif","no_telp" => "081222498686"]);
		$this->seeInDatabase('mahasiswa', [
		         'nama_mahasiswa' => 'Afif','no_telp' => "081222498686"
		      ]);
		
		$update_Mahasiswa::find($mahasiswa->id)->update(["nama_mahasiswa" => "maulana","no_telp" =>"081222498585"]);
		$this->seeInDatabase('mahasiswa', [
         'nama_mahasiswa' => 'maulana','no_telp' => "081222498585"
		      ]);
		// $hapus_mahasiswa = Mahasiswa::destroy($mahasiswa->id);
		// $this->assertTrue($hapus_mahasiswa);

		
    }
}
