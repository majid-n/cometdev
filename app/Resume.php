<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->belongsTo('App\Comment');
    }
}
