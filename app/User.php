<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Session;
use Yajra\Auditable\AuditableTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'otoritas', 'is_verified', 'team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    // mengambil data roleUser dari model RoleUser (Proses Relasi)
    // berdasarkan foreign key User->'id', reference 'RoleUser'('role_id')
   public function roleUser()
    {
        return $this->belongsTo('App\RoleUser', 'id','user_id');
    }

    public function teamUser() {
        return $this->belongsTo('App\TeamUser', 'id','user_id');
    } 

    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function teams() {
            return $this->hasMany('App\Team');
        }

}
