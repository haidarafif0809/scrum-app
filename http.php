<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Bank;
use App\User;
use URL;

class BankTest extends TestCase
{

  use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */

    protected function setUp() {
        parent::setUp();
        // kode untuk menset base url nya jadi localhost
        //   karena kalau gak localhost jadi tidak bisa jalan testing http nya
        //  selalu responnya 404 
        URL::forceRootUrl('http://localhost');    
    }

//CRUD TESTING
    public function testBankCrud() {
      
      //TAMBAH BANK
        $bank = Bank::create(["nama_bank" => "BRI","atas_nama" => "Rindang Ramadhan","no_rek"=>"1234567890"]);
    $this->assertDatabaseHas('banks', ["nama_bank" => "BRI","atas_nama" => "Rindang Ramadhan","no_rek"=>"1234567890"]);
 
    //UPDATE BANK
    Bank::find($bank->id)->update(["nama_bank" => "BCA", "atas_nama"=>"Afrizal Ansyah", "no_rek"=>"9876543210"]);
      $this->assertDatabaseHas('banks', ["nama_bank" => "BCA", "atas_nama" => "Afrizal Ansyah", "no_rek" => "9876543210"]);

    //DELETE BANK
    $hapus_bank = Bank::destroy($bank->id);

        $bank = Bank::find($bank->id);
        $this->assertDatabaseMissing('banks', ["nama_bank" => "BCA", "atas_nama" => "Afrizal Ansyah", "no_rek" => "9876543210"]);

    }
}