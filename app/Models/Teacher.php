<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['titular','committee','schedule','career_id', 'jury_id'];

    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function ideas()
    {
        return $this->hasMany('App\Models\TeacherPlan');
    }

    public function career()
    {
        return $this->belongsTo('App\Models\Career', 'career_id');
    }

    public function jury()
    {
        return $this->belongsToMany('App\Models\Jury');
    }
}
