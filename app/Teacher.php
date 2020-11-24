<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['titular','committee'];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function ideas()
    {
        return $this->hasMany('App\TeacherPlan');
    }
}
