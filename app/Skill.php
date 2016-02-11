<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
	protected $fillable = ['user_id', 'title', 'score'];

	# Relationship for User Model
    public function user() {
        return $this->belongsTo('App\User');
    }
}
