<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Post extends Model
{   
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function totalLikes(){
    	return DB::table('likes')
    				->where('post_id' , '=' , $this->id)
    				->count();
    }

    public function isLiked(){
    	return DB::table('likes')
                    ->where([
                        ['post_id', '=', $this->id],
                        ['ip' , '=', request()->ip()],
                    ])
    				->count();
    }

    public function catName(){
        return DB::table('cats')
                    ->where('id', $this->parent)
                    ->value('title');
    } 
}
