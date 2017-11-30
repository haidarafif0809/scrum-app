<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Aplication extends Model
{
    use AuditableTrait;
    //create new model
    protected $fillable = ['kode', 'nama'];

    public function backlog()
    {
        return $this->hasMany('App\Backlog');
    }
}
