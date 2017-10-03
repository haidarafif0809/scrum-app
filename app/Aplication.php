<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplication extends Model
{
    //create new model
    protected $fillable = ['kode','nama'];

    public function backlog() {
    	return $this->hasMany('App\Backlog');
    }
}
