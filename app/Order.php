<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['waktu_pembayaran', 'amount', 'type', 'id_siswa'];

    public function students()
    {
        return $this->belongsTo('App\Student', 'id_siswa');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
}
