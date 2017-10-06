<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    //
        protected $fillable = [ 'user_id','team_id'];

        public function team() {
    	return $this->belongsTo('App\Team');
    }	
}
