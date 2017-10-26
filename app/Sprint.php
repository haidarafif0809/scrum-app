<?php 
 
namespace App;
Use App\Team; 
 
use Illuminate\Database\Eloquent\Model;

 
class Sprint extends Model 
{ 
   	protected $fillable = ['kode_sprint', 'nama_sprint', 'tanggal_mulai', 'durasi', 'waktu_mulai', 'team_id']; 
   

    public function team() {
      return $this->belongsTO('App\Team');
    }
    public function sprintbacklog() {
    	return $this->belongsTo('App\Sprintbacklog');
    }
}	

//   	public function setTanggalMulaiAttribute($date) {
//   		$date = date_create($date);

// 		$this->attributes['tanggal_mulai'] = date_format($date, 'Y-m-d');
// 	}
// 	public function getTanggalMulaiAttribute($date) {
// 		return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
// 	}

// 	public function team() {
// 		return $this->belongsTo('App\Team');
// 	}

// } 
	

