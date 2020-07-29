<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = ['apto'];

    public function projects()
    {
        return $this->belongsToMany('App\Project    ')->withTimestamps();
    }
}
