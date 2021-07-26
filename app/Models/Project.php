<?php

namespace App\Models;

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
        'status',
        'highlights'
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
        return $this->belongsToMany('App\Models\Student')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }



}
