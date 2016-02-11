<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{	

	protected $fillable = ['from_user_id', 'to_user_id', 'text'];

	# Relationship for Comment that user Submit
    public function fromUser() {
        return $this->belongsTo('App\User','from_user_id');
    }

    # Relationship for Comment on the specific User Profile
    public function toUser() {
        return $this->belongsTo('App\User','to_user_id');
    }
}
