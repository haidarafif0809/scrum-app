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
        $aplication1 = Aplication::create(['kode'=>'1','nama'=>'Aplikasi Absen Siswa']);
        $aplication2 = Aplication::create(['kode'=>'2','nama'=>'Aplikasi Toko Dasar']);
        $aplication3 = Aplication::create(['kode'=>'3','nama'=>'Aplikasi Toko Ozora']);
        $aplication3 = Aplication::create(['kode'=>'4','nama'=>'Aplikasi Scrum']);
        $aplication3 = Aplication::create(['kode'=>'5','nama'=>'Aplikasi Unila']);
        $aplication3 = Aplication::create(['kode'=>'6','nama'=>'Aplikasi Larapus']);
    }
}
