<?php 
 
namespace App; 
 
use Illuminate\Database\Eloquent\Model;

 
class Sprint extends Model 
{ 
   	protected $fillable = ['kode_sprint', 'nama_sprint', 'tanggal_mulai', 'durasi', 'waktu_mulai', 'team']; 


} 