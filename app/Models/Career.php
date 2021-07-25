<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['name'];

    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

}
