<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{	

	protected $fillable = ['from_user_id', 'to_user_id', 'score'];

	# Relationship for Rate that user Submit
	public function fromUser() {
	    return $this->belongsTo('App\User','from_user_id');
	}

	# Relationship for Rate on the specific User Profile
	public function toUser() {
	    return $this->belongsTo('App\User','to_user_id');
	}
}
