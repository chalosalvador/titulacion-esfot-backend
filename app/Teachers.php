<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $fillable = ['titular'];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
