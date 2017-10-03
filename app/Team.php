<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Team extends Model
{

	public static function boot()
	{

	self::deleting(function($team)
	{
		if ($team->user()->count() > 0) {
				Session::flash("flash_notification", [
					"level"=>"danger",
					"message"=> "Team ". $team->nama_team ." masih digunakan."
				]);
			return false;
			}
		});
	}

        protected $fillable = ['kode_team', 'nama_team'];

        public function user() {
        	return $this->hasMany('App\User');
        }
}
