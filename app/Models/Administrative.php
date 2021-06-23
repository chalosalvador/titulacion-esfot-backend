<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrative extends Model
{
//    protected $protected = ['users_id'];
    protected $fillable = ['office'];

    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }
}
