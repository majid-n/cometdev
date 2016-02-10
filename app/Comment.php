<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function fromUser() {
        return $this->belongsTo('App\User','from_user_id');
    }

    public function toUser() {
        return $this->belongsTo('App\User','to_user_id');
    }
}
