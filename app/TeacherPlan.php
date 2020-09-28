<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeacherPlan extends Model
{
    protected $fillable = ['title','problem','solution','status'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->teacher_id = Auth::id();
        });
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
