<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'title',
        'general_objective',
        'problem','hypothesis',
        'justification',
        'specifics_objectives',
        'teacher_id',
        'schedule',
        'methodology',
        'work_plan',
        'research_line',
        'knowledge_area'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->status = 'plan_sent';
        });
    }


    public function students()
    {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id');
    }



}
