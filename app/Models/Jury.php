<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    protected $protected = ['users_id'];
    protected $fillable = [
        'tribunalSchedule',
        'member1',
        'member2',
        'member3',
        'career_id',
        'project_id'
    ];
}
