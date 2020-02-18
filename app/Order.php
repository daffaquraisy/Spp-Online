<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pembayaran';

    public function students()
    {
        return $this->belongsTo('App\Student', 'id_siswa');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'id_petugas');
    }
}
