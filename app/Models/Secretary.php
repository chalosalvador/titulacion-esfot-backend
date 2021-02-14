<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    protected $fillable = ['office'];

    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }
}
