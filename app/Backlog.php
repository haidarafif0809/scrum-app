<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $fillable = ['aplikasi', 'nama', 'demo', 'catatan'];

    public function getKolomAttribute() {
    	$jumlahKolom = Backlog::all()->count();

    	return $jumlahKolom;
    }
}
