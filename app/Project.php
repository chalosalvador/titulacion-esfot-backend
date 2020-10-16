<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'title',
        'title_comment',
        'general_objective',
        'general_objective_comment',
        'problem',
        'problem_comment',
        'hypothesis',
        'hypothesis_comment',
        'justification',
        'justification_comment',
        'specifics_objectives',
        'specifics_objectives_comment',
        'teacher_id',
        'schedule',
        'schedule_comment',
        'methodology',
        'methodology_comment',
        'work_plan',
        'work_plan_comment',
        'research_line',
        'knowledge_area',
        'bibliography',
        'bibliography_comment',
        'project_type',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->status = 'plan_saved';
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
