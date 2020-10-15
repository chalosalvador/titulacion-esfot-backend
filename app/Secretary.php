<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    protected $fillable = ['office'];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
