<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talon extends Model
{
    public function medSmena()
    {
        return $this->belongsTo('App\MedSmena');
    }

    public function medCase()
    {
        return $this->hasOne('App\MedCase');
    }
}
