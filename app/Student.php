<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nisn', 'nis', 'nama', 'alamat', 'no_telp', 'id_kelas', 'id_spp'];

    public function spp()
    {
        return $this->belongsTo('App\Spp', 'id_spp');
    }

    public function classrooms()
    {
        return $this->belongsTo('App\Classroom', 'id_kelas');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
