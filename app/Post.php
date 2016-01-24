<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Helper\Time;

class Post extends Model
{
    protected $table = 'posts';

    public function totalLikes(){
    	return DB::table('likes')
    				->join('posts' ,'posts.id' ,'=' ,'likes.post_id' )
    				->where('post_id' , '=' , $this->id)
    				->count();
    }

    public function isLiked(){
    	return DB::table('likes')
    				->where('post_id' , '=' , $this->id)
    				->where('ip' , '=', request()->ip())
    				->count();
    }

    // public function Like(){
    //     return DB::table('likes')->insert([
    //                 'post_id'   => $this->id,
    //                 'ip'        => request()->ip(),
    //                 'likedat'   => Time::Now()
    //             ]);
    // }
}