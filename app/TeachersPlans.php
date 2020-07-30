<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeachersPlans extends Model
{
    protected $fillable = ['title','problem','solution','teachers_id'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->teachers_id = Auth::id();
        });
    }
}
