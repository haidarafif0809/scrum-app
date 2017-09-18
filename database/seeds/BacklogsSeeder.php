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
		$backlog1 = Backlog::create(['aplikasi' => '1', 'nama' => 'Nama1', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
		$backlog2 = Backlog::create(['aplikasi' => '2', 'nama' => 'Nama2', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
		$backlog3 = Backlog::create(['aplikasi' => '3', 'nama' => 'Nama3', 'demo' => 'Tes demo', 'catatan' => 'Tes catatan']);
    }
}
