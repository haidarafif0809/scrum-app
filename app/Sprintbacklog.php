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
		return $this->belongsTo('App\backlog','id_backlog', 'id_backlog');
	}
	public function waktuFinishSprintBacklog($waktuMulai, $waktuFinish)
	{
		$mulai = $waktuMulai;
		$finish = $waktuFinish;
		$hasilWaktu = ceil($finish - $mulai);
		if ($hasilWaktu < 59) {
			$str = 'Selesai dalam 1 menit';
		}
		else if ($hasilWaktu > 59 && $hasilWaktu < 3600) {
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 60)) - 1) .' menit';
		}
            // 28.800 delapan jam. disini dianggap 1 hari
		else if ($hasilWaktu > 3599 && $hasilWaktu < 28800)  {
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 3600)) - 1) .' jam';
		}
            // 201.600 disini satu minggu. kelipatan 7 dari 28.800
		else if ($hasilWaktu > 28800 && $hasilWaktu < 201600) {
			$str = 'Selesai dalam '. (ceil(($hasilWaktu / 28800)) - 1) .' hari';
		}
            // 864.000 disini satu bulan. kelipatan 4 dari 201.600 dan ditambah 57.600 (dua hari)
            // kelipatan 2 dari 28.800
            // karena satu bulan adalah 4 minggu 2 hari
		else if ($hasilWaktu > 201600 && $hasilWaktu < 864000) {
			if (($hasilWaktu % 201600) < 28800) {                    
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 201600)) - 1) .' minggu';
			}
			else {
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 201600)) - 1) .' minggu '. ceil(($hasilWaktu % 201600) / 28800 - 1) .' hari';

			}
		}
		else if ($hasilWaktu > 864000) {
			if (($hasilWaktu % 864000) < 201600) {
				$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan';
			}
			else {
				if (($hasilWaktu % 864000 % 201600) < 28800) {
					$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan '. (ceil(($hasilWaktu % 864000) / 201600) - 1) .' minggu';
				}
				else {
					$str = 'Selesai dalam '. (ceil(($hasilWaktu / 864000)) - 1) .' bulan '. (ceil(($hasilWaktu % 864000) / 201600) - 1) .' minggu '. (ceil(($hasilWaktu % 864000 % 201600) / 28800) - 1) .' hari';
				}
			}
		}
		if (!empty($str)) return $str;
		else return null;
	}
}