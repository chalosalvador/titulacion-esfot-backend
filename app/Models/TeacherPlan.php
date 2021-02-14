<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeacherPlan extends Model
{
    protected $fillable = ['title','problem','solution','status'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $user = Auth::user();
            $project->teacher_id = $user->userable->id;
            $project->status = 'idea_unassigned';
        });
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
