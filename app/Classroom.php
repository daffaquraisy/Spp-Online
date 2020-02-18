<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
