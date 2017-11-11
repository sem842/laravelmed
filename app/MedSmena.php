<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedSmena extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function medService()
    {
        return $this->belongsTo('App\MedService');
    }

    public function medCases()
    {
        return $this->hasMany('App\MedCase');
    }
}
