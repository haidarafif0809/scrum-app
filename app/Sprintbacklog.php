<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Sprintbacklog extends Model
{
    use AuditableTrait;

    public function sprint()
    {
        return $this->belongsTo('App\Sprint', 'id_sprint', 'id');
    }
    public function backlog()
    {
        return $this->belongsTo('App\Backlog', 'id_backlog', 'id_backlog');
    }
    public function waktuFinishSprintBacklog($waktuMulai, $waktuFinish)
    {
        // Waktu mulai
        $mulai = $waktuMulai;
        // Waktu finish
        $finish = $waktuFinish;

        // Jumlah waktu (dalam detik) dalam menyelesaikan satu backlog
        $hasilWaktu = ceil($finish - $mulai);

        // Jika kurang dari 1 menit
        if ($hasilWaktu < 59) {
            // Maka tampilkan jumlah detiknya
            $str = 'Selesai dalam ' . $hasilWaktu . ' detik';
        }

        // Jika lebih dari 1 menit dan kurang dari 1 jam
        else if ($hasilWaktu > 59 && $hasilWaktu < 3600) {
            // Maka tampilkan jumlah menitnya
            $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 60)) - 1) . ' menit';
        }

        // Jika lebih dari 1 menit dan kurang dari 1 jam
        else if ($hasilWaktu > 59 && $hasilWaktu < 3600) {
            // Maka tampilkan jumlah menitnya
            $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 60)) - 1) . ' menit';
        }

        // 86400 detik adalah 1 hari
        // Jika lebih dari 1 jam dan kurang dari 1 hari
        else if ($hasilWaktu > 3599 && $hasilWaktu < 86400) {
            // Maka tampilkan jumlah jamnya
            $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 3600)) - 1) . ' jam';
        }

        // 604800 detik adalah 1 minggu
        // Jika lebih dari 1 hari dan kurang dari 1 minggu
        else if ($hasilWaktu > 86400 && $hasilWaktu < 604800) {
            // Maka tampilkan jumlah harinya
            $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 86400)) - 1) . ' hari';
        }

        // 2592000 detik adalah 1 bulan
        // Jika lebih dari 1 minggu dan kurang dari 1 bulan
        else if ($hasilWaktu > 604800 && $hasilWaktu < 2592000) {

            // Jika sisa bagi kurang dari 1 hari
            if (($hasilWaktu % 604800) < 86400) {
                // Maka hanya tampilkan jumlah minggunya
                $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 604800)) - 1) . ' minggu';
            }

            // Jika sisa bagi lebih dari 1 hari
            else {
                // Maka tampilkan jumlah minggu dan kelebihan harinya
                $str = 'Selesai dalam ' . (ceil(($hasilWaktu / 604800)) - 1) . ' minggu ' . ceil(($hasilWaktu % 604800) / 86400 - 1) . ' hari';

            }
        }
        // Jika lebih dari 1 bulan
        else if ($hasilWaktu > 2592000) {

            if (!empty($str)) {
                return $str;
            } else {
                return null;
            }

        }
    }

    public static function hitungPerkiraanWaktu($angka)
    {
        $sliceAngka  = explode(',', trim($angka));
        $array_angka = [];
        foreach ($sliceAngka as $num) {
            array_push($array_angka, $num);
        }
        $hasil = array_sum($array_angka);
        $hasil = ceil($hasil / count($sliceAngka));
        return $hasil;
    }
}
