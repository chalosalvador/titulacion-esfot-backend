<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'commissionSchedule',
        'member1',
        'member2',
        'member3',
        'careerName'
    ];
}
