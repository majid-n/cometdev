<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

	protected $fillable = ['user_id', 'post_id'];

	# Relationship for Post Model
	public function post(){
		return $this->belongsTo('App\Post');
	}

	# Relationship for User Model
	public function user(){
		return $this->belongsTo('App\User');
	}
}
