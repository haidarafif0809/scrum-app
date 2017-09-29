<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Sprintbacklog extends Model 
{ 
    protected $fillable = ['backlog', 'isi_kepentingan','perkiraan_waktu']; 
} 