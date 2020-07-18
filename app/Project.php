<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function students()
    {
        return $this->belongsToMany('App\Students')->withTimestamps();
    }
}
