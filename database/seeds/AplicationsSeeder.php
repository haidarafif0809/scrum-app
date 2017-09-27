<?php

use Illuminate\Database\Seeder;
use App\Aplication;
class AplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sample masterdata aplikasi
        $aplication1 = Aplication::create(['kode'=>'1','nama'=>'Aplikasi absen siswa']);
        $aplication2 = Aplication::create(['kode'=>'2','nama'=>'Aplikasi toko dasar']);
        $aplication3 = Aplication::create(['kode'=>'3','nama'=>'Aplikasi CMD']);
    }
}
