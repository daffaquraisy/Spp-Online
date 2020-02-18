<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';

    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
