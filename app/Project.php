<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['status', 'title', 'general_objective', 'specifics_objective', 'report_pdf'];

    public function students()
    {
        return $this->belongsToMany('App\Students')->withTimestamps();
    }



}
