<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	public $timestamps = false;

	# prevent using update_at field
	public static function boot() {
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
