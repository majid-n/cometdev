<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Mail;
use App\Like;
use App\Post;
use App\Support;

class AjaxController extends Controller
{
    
    # Like each Post from Portfiolio Section
    public function likePost(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {

            if( $request->has('pid') ) {

                $post = Post::with('likes')->find( $request->pid );

                if( $post->isLiked() > 0 ) {
                    # When User Liked this Post
                    $isdeleted = $post->likes()->where([
                                    ['post_id', $post->id],
                                    ['ip', $request->ip()],
                                ])->delete();

                    if( $isdeleted ) {

                        $totalpostlikes = $post->likes()->where('post_id', $post->id)->count();
                        $totallikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'unlike',
                                        'totalpostlikes'    => $totalpostlikes,
                                        'totallikes'        => $totallikes
                                    ]
                                );
                    }
                }else{
                    # When User didn't Like this Post before
                    $like           = new Like;
                    $like->ip       = $request->ip();
                    $like->post_id  = $post->id;

                    if( $post->likes()->save($like) ) {

                        $totalpostlikes = $post->likes()->where('post_id', $like->post_id)->count();
                        $totallikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'like',
                                        'totalpostlikes'    => $totalpostlikes,
                                        'totallikes'        => $totallikes
                                    ]
                                );
                    }
                }
            }  
        }
            
        return response()->json([ 'result' =>  false ]);
    }
}
