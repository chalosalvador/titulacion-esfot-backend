<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeacherPlan extends Model
{
    protected $fillable = ['title','problem','solution'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->teachers_id = Auth::id();
        });
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
