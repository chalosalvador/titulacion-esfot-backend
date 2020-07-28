<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = ['status', 'title', 'general_objective', 'specifics_objectives', 'uploaded_at', 'report_pdf', 'report_uploaded_at', 'report_modified_at','teachers_id'];

//    public static function boot()
//    {
//        parent::boot();
//        static::creating(function ($project) {
//            $project->teachers_id = Auth::id();
//        });
//    }


    public function students()
    {
        return $this->belongsToMany('App\Students')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teachers');
    }



}
