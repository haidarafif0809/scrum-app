<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $fillable = ['aplikasi', 'nama', 'demo', 'catatan'];
}
