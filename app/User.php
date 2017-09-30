<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'otoritas', 'is_verified',
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
}
