<?php

use Illuminate\Database\Seeder;
use App\Backlog;

class BacklogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Backlog
		$backlog1 = Backlog::create(['aplikasi_id' => 4, 'aplikasi' => 'Aplikasi Scrum', 'nama' => 'Nama1', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
		$backlog2 = Backlog::create(['aplikasi_id' => 5, 'aplikasi' => 'Aplikasi Unila', 'nama' => 'Nama2', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
		$backlog3 = Backlog::create(['aplikasi_id' => 6, 'aplikasi' => 'Aplikasi Larapus', 'nama' => 'Nama3', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
    }
}
