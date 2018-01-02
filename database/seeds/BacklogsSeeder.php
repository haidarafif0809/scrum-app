<?php

use App\Backlog;
use Illuminate\Database\Seeder;

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
        $backlog1 = Backlog::create(
            [
                'aplikasi_id'  => 1,
                'nama_backlog' => 'Backlog Aplikasi Absen Siswa',
                'demo'         => 'Tes demo Aplikasi Absen Siswa',
                'catatan'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ]
        );
        $backlog2 = Backlog::create(
            [
                'aplikasi_id'  => 5,
                'nama_backlog' => 'Backlog Aplikasi Unila',
                'demo'         => 'Tes demo Aplikasi Unila',
                'catatan'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ]
        );
        $backlog3 = Backlog::create(
            [
                'aplikasi_id'  => 6,
                'nama_backlog' => 'Backlog Aplikasi Larapus',
                'demo'         => 'Tes demo Aplikasi Larapus',
                'catatan'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ]
        );
    }
}
