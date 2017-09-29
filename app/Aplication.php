<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplication extends Model
{
    //create new model
    protected $fillable = ['kode','nama'];

    public function aplikasi() {
    	return $this->belongsTo('App\Aplication');
    }
}
