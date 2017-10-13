<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Sprintbacklog extends Model 
{ 
    protected $fillable = ['isi_kepentingan','perkiraan_waktu', 'id_backlog', 'id_sprint']; 

	public function sprint()
	{
	return $this->belongsTo('App\Sprint','id','id_sprint');
	}
	public function backlog()
	{
	return $this->belongsTo('App\backlog','id','id_backlog');
	}
}