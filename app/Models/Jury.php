<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    protected $protected = ['users_id'];
    protected $fillable = [
        'tribunalSchedule',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher');
    }
}
