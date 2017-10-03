<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $fillable = ['aplikasi_id', 'nama_backlog', 'demo', 'catatan'];

    public function getKolomAttribute() {
    	$jumlahKolom = Backlog::all()->count();

    	return $jumlahKolom;
    }

    public function aplikasi() {
    	return $this->belongsTo('App\Aplication');
    }
}
