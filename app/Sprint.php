<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model;

 
class Sprint extends Model 
{ 
   	protected $fillable = ['kode_sprint', 'nama_sprint', 'tanggal_mulai', 'durasi', 'waktu_mulai', 'team']; 

  	public function setTanggalMulaiAttribute($date) {
  		$date = date_create($date);

		$this->attributes['tanggal_mulai'] = date_format($date, 'Y-m-d');
	}
	public function getTanggalMulaiAttribute($date) {
		return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
	}

	public function team() {
		$this->belongsTo('App\Team');
	}

} 