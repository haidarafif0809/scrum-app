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

    public function user() {
        	return $this->belongsTo('App\User');
        }


   
	
	public function scopeMember($query)
	{
		return $query->where('team_id');
	}
}
