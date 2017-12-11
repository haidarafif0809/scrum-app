<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Backlog extends Model
{
    use AuditableTrait;
    protected $fillable   = ['aplikasi_id', 'nama_backlog', 'demo', 'catatan'];
    protected $primaryKey = 'id_backlog';

    public function getKolomAttribute()
    {
        $jumlahKolom = Backlog::all()->count();

        return $jumlahKolom;
    }

    public function aplikasi()
    {
        return $this->hasOne('App\Aplication', 'id', 'aplikasi_id');
    }

    public function sprintBacklog()
    {
        return $this->hasMany('App\Sprintbacklog', 'id', 'backlog_id');
    }

    public function translateTextTime($time)
    {
        $time     = date('D, d M Y \P\u\k\u\l H:i', strtotime($time));
        $arrayDay = [
            'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
        ];
        $arrayHari = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu',
        ];
        $arrayMonth = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ];
        $arrayBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];
        $time = str_replace($arrayDay, $arrayHari, $time);
        $time = str_replace($arrayMonth, $arrayBulan, $time);
        return $time;
    }
}
