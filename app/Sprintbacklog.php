<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Sprintbacklog extends Model 
{ 
    protected $fillable = ['backlog_id', 'isi_kepentingan','perkiraan_waktu']; 
} 