<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Users\EloquentUser as User;

class Post extends Model
{   
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title','description','cat_id','smalldescription','link','thumb','image'];
    
    
    public function isLiked( User $user ){
        return $this->likes()->where('user_id', $user->id)->count();
    }

    public function cat() {
        return $this->belongsTo('App\Cat');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
}
