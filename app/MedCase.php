<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedCase extends Model
{
    public function talon()
    {
        return $this->belongsTo('App\Talon');
    }

    public function medSmena()
    {
        return $this->belongsTo('App\MedSmena');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
