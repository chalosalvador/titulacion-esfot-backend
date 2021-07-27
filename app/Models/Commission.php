<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'commission_schedule',
        'career_id'
    ];


    public function teachers(){
        return $this->hasMany('App\Models\Teacher');
    }

    public function career(){
        return $this->belongsTo('App\Models\Career');
    }
}
