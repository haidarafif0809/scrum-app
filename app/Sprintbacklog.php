<?php 

namespace App; 

use Illuminate\Database\Eloquent\Model; 

class Sprintbacklog extends Model 
{ 
	protected $fillable = ['isi_kepentingan','perkiraan_waktu', 'id_backlog', 'id_sprint', 'assign_user_id', 'assign', 'finish', 'waktu_mulai', 'waktu_finish']; 

	public function sprint()
	{
		return $this->belongsTo('App\Sprint','id_sprint', 'id');
	}
	public function backlog()
	{
		return $this->belongsTo('App\Backlog','id_backlog', 'id_backlog');
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
			$str = 'Selesai dalam '. $hasilWaktu .' detik';
		}

		// Jika lebih dari 1 menit dan kurang dari 1 jam
		else if ($hasilWaktu > 59 && $hasilWaktu < 3600) {
			// Maka tampilkan jumlah menitnya
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 60)) - 1) .' menit';
		}

        // 28.800 detik adalah delapan jam. disini dianggap 1 hari
		// Jika lebih dari 1 jam dan kurang dari 1 hari
		else if ($hasilWaktu > 3599 && $hasilWaktu < 28800)  {
			// Maka tampilkan jumlah jamnya
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 3600)) - 1) .' jam';
		}

        // 201.600 detik disini 1 minggu. kelipatan 7 dari 28.800 detik
        // Jika lebih dari 1 hari dan kurang dari 1 minggu
		else if ($hasilWaktu > 28800 && $hasilWaktu < 201600) {
			// Maka tampilkan jumlah harinya
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 28800)) - 1) .' hari';
		}

        // 864.000 detik disini 1 bulan. kelipatan 4 dari 201.600 detik
        // dan ditambah 57.600 detik (dua hari) kelipatan 2 dari 28.800 detik
        // karena 1 bulan adalah 4 minggu 2 hari
		
		// Jika lebih dari 1 minggu dan kurang dari 1 bulan
		else if ($hasilWaktu > 201600 && $hasilWaktu < 864000) {
			
			// Jika sisa bagi kurang dari 1 hari
			if (($hasilWaktu % 201600) < 28800) {                    
				// Maka hanya tampilkan jumlah minggunya 
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 201600)) - 1) .' minggu';
			}

			// Jika sisa bagi lebih dari 1 hari
			else {
				// Maka tampilkan jumlah minggu dan kelebihan harinya
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 201600)) - 1) .' minggu '. ceil(($hasilWaktu % 201600) / 28800 - 1) .' hari';

			}
		}
		// Jika lebih dari 1 bulan
		else if ($hasilWaktu > 864000) {

			// Jika sisa bagi kurang dari 1 minggu
			if (($hasilWaktu % 864000) < 201600) {
				// Maka hanya tampilkan jumlah bulannya
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan';
			}
			else {
				// Jika sisa bagi (bulan dilanjutkan dengan minggu) kurang dari 1 hari
				if (($hasilWaktu % 864000 % 201600) < 28800) {
					// Maka hanya tampilkan jumlah bulan dan kelebihan minggunya
					$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan '. (ceil(($hasilWaktu % 864000) / 201600) - 1) .' minggu';
				}
				// Jika sisa bagi (bulan dilanjutkan dengan minggu) lebih dari 1 hari
				else {
					// Maka tampilkan jumlah bulan, kelebihan minggu dan harinya
					$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan '. (ceil(($hasilWaktu % 864000) / 201600) - 1) .' minggu '. (ceil(($hasilWaktu % 864000 % 201600) / 28800) - 1) .' hari';
				}
			}
		}

		if (!empty($str)) return $str;
		else return null;
	}
}