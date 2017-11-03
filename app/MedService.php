<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedService extends Model
{
    public function canDestroy()
    {
        return true;
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function medSmenas()
    {
        return $this->hasMany('App\MedSmena');
    }
}
