<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
