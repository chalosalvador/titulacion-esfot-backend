<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['apto','unique_number'];

    public function projects()
    {
        return $this->belongsToMany('App\Project')->withTimestamps();
    }
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
