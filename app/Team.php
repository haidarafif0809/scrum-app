<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
        protected $fillable = ['kode_team', 'nama_team'];

        public function user() {
        	return $this->hasMany('App\User');
        }
}
