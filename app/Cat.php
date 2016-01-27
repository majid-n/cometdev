<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
