<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function canDestroy()
    {
        return $this->users->isEmpty();
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function medService()
    {
        return $this->hasMany('App\MedService');
    }
}
