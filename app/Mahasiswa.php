<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	protected $fillable = ['nama_mahasiswa', 'no_telp'];
	protected $table = 'mahasiswa';
}
