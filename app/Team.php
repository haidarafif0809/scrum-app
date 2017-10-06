<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Team extends Model
{

	


        protected $fillable = ['kode_team', 'nama_team'];

        public function user() {
        	return $this->hasMany('App\TeamUser');
        }

        public function sprint() {
        	return $this->hasMany('App\Sprint');
        }


}
