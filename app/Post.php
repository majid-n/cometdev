<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Like;

class Post extends Model
{   
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function totalLikes(){
    	return Like::where('post_id' , $this->id)
    				->count();
    }

    public function isLiked(){
    	return Like::where([
                        ['post_id', '=', $this->id],
                        ['ip' , '=', request()->ip()],
                    ])
    				->count();
    }

    public function cat() {
        return $this->belongsTo('App\Cat');
    }
}
