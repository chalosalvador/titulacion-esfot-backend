<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['apto','unique_number'];

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project')->withTimestamps();
    }
    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }

    public function career()
    {
        return $this->belongsTo('App\Models\Career', 'career_id');
    }
}
