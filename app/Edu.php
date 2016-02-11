<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edu extends Model
{	
	protected $fillable = ['user_id', 'startyear', 'endyear', 'degree', 'uni', 'score'];

	# Relationship for User Model
    public function user() {
        return $this->belongsTo('App\User');
    }
}
