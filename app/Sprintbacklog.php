<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Sprintbacklog extends Model 
{ 
    protected $fillable = ['isi_kepentingan','perkiraan_waktu', 'id_backlog', 'id_sprint', 'asign']; 

	public function sprint()
	{
	return $this->belongsTo('App\Sprint','id_sprint', 'id');
	}
	public function backlog()
	{
	return $this->belongsTo('App\backlog','id_backlog', 'id_backlog');
	}
}