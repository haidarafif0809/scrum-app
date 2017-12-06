<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Team extends Model
{

    use AuditableTrait;

    protected $fillable = ['kode_team', 'nama_team'];

    public function user()
    {
        return $this->hasMany('App\TeamUser');
    }

    public function sprint()
    {
        return $this->hasMany('App\Sprint', 'id', 'team_id');
    }

    public function teamUser()
    {
        return $this->belongsTo('App\TeamUser', 'id', 'team_id');
    }

}
