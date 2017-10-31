<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedService extends Model
{
    public function group()
    {
        $this->belongsTo('App\Group');
    }
}
