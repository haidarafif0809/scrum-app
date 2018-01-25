<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Sprintbacklog extends Model
{
    use AuditableTrait;

    protected $fillable = ['isi_kepentingan', 'perkiraan_waktu', 'id_backlog', 'id_sprint', 'assign_user_id', 'assign', 'finish', 'waktu_assign', 'waktu_finish', 'total_waktu', 'pause', 'waktu_pause', 'waktu_play'];

    public function sprint()
    {
        return $this->belongsTo('App\Sprint', 'id_sprint', 'id');
    }

    public function backlog()
    {
        return $this->belongsTo('App\Backlog', 'id_backlog', 'id_backlog');
    }
    public function waktuFinishSprintBacklog($waktu)
    {
        // Waktu mulai
        // $mulai = $waktuAssign;
        // Waktu finish
        // $finish = $waktuFinish;

        // Jumlah waktu (dalam detik) dalam menyelesaikan satu backlog
        // $hasilWaktu = ceil($finish - $mulai);

        // Jika kurang dari 1 menit
        if ($waktu < 59) {
            // Maka tampilkan jumlah detiknya
            $str = 'Selesai dalam ' . $waktu . ' detik';
        }

        // Jika lebih dari 1 menit dan kurang dari 1 jam
        else if ($waktu > 59 && $waktu < 3600) {
            if (($waktu % 60) == 0) {

                // Maka tampilkan jumlah menitnya
                $str = 'Selesai dalam ' . (ceil($waktu / 60) - 1) . ' menit';
            } else {
                $str = 'Selesai dalam ' . (ceil($waktu / 60) - 1) . ' menit ' . ceil(($waktu % 60) - 1) . ' detik';

            }
        }

        // 86400 detik adalah 1 hari
        // Jika lebih dari 1 jam dan kurang dari 1 hari
        else if ($waktu > 3599 && $waktu < 86400) {
            // Maka tampilkan jumlah jamnya
            $str = 'Selesai dalam ' . (ceil(($waktu / 3600)) - 1) . ' jam';
        }

        // 604800 detik adalah 1 minggu
        // Jika lebih dari 1 hari dan kurang dari 1 minggu
        else if ($waktu > 86400 && $waktu < 604800) {
            // Maka tampilkan jumlah harinya
            $str = 'Selesai dalam ' . (ceil(($waktu / 86400)) - 1) . ' hari';
        }

        // 2592000 detik adalah 1 bulan
        // Jika lebih dari 1 minggu dan kurang dari 1 bulan
        else if ($waktu > 604800 && $waktu < 2592000) {

            // Jika sisa bagi kurang dari 1 hari
            if (($waktu % 604800) < 86400) {
                // Maka hanya tampilkan jumlah minggunya
                $str = 'Selesai dalam ' . (ceil(($waktu / 604800)) - 1) . ' minggu';
            }

            // Jika sisa bagi lebih dari 1 hari
            else {
                // Maka tampilkan jumlah minggu dan kelebihan harinya
                $str = 'Selesai dalam ' . (ceil(($waktu / 604800)) - 1) . ' minggu ' . ceil(($waktu % 604800) / 86400 - 1) . ' hari';

            }
        }
        // Jika lebih dari 1 bulan
        else if ($waktu > 2592000) {

            // Jika sisa bagi kurang dari 1 minggu
            if (($waktu % 2592000) < 604800) {
                // Maka hanya tampilkan jumlah bulannya
                $str = 'Selesai dalam ' . (ceil(($waktu / 2592000)) - 1) . ' bulan';
            } else {
                // Jika sisa bagi (bulan dilanjutkan dengan minggu) kurang dari 1 hari
                if (($waktu % 2592000 % 604800) < 86400) {
                    // Maka hanya tampilkan jumlah bulan dan kelebihan minggunya
                    $str = 'Selesai dalam ' . (ceil(($waktu / 2592000)) - 1) . ' bulan ' . (ceil(($waktu % 2592000) / 604800) - 1) . ' minggu';
                }
                // Jika sisa bagi (bulan dilanjutkan dengan minggu) lebih dari 1 hari
                else {
                    // Maka tampilkan jumlah bulan, kelebihan minggu dan harinya
                    $str = 'Selesai dalam ' . (ceil(($waktu / 2592000)) - 1) . ' bulan ' . (ceil(($waktu % 2592000) / 604800) - 1) . ' minggu ' . (ceil(($waktu % 2592000 % 604800) / 86400) - 1) . ' hari';
                }
            }
        }

        if (!empty($str)) {
            return $str;
        } else {
            return null;
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
