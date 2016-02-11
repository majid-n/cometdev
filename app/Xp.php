<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xp extends Model
{	
	
	protected $fillable = ['user_id', 'startyear', 'endyear', 'company'];

	# Relationship for User Model
    public function user() {
        return $this->belongsTo('App\User');
    }
}
