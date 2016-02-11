<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{	

	protected $fillable = ['user_id', 'tel', 'duty', 'rel', 'jobtitle', 'address', 'bio', 'birth'];

	# Relationship for User Model
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
