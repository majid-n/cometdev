<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Like;
use Sentinel;

class PostController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Like each Post from Portfiolio Section
    public function like( Request $request, Post $post ) {

        if( $user = Sentinel::getUser() ){

            if( $post->isLiked( $user ) > 0 ) {
                
                # When User Liked this Post
                $isdeleted = $post->likes()->where('user_id', $user->id)
                                           ->delete();

                if( $isdeleted ) {

                    $totalpostlikes = $post->likes()->count();
                    $totallikes     = Like::count();

                    if(  $request->ajax() )
                        return  response()->json([
                                    'result'            => true,
                                    'status'            => 'unlike',
                                    'totalpostlikes'    => $totalpostlikes,
                                    'totallikes'        => $totallikes
                                ]);
                    else
                        return redirect()->route('post.show',['post' => $post->id])
                                         ->with('success','درخواست شما با موفقیت انجام شد.');
                }
            }else{

                # When User didn't Like this Post before
                $like           = new Like;
                $like->user_id  = $user->id;

                if( $post->likes()->save($like) ) {

                    $totalpostlikes = $post->likes()->count();
                    $totallikes     = Like::count();

                    if(  $request->ajax() )
                        return  response()->json([
                                        'result'            => true,
                                        'status'            => 'like',
                                        'totalpostlikes'    => $totalpostlikes,
                                        'totallikes'        => $totallikes
                                    ]);
                    else
                        return redirect()->route('post.show',['post' => $post->id])
                                         ->with('success','پست با موفقیت لایک شد.');
                }
            }
        }
        
        if( $request->ajax() ) return response()->json([ 'result' =>  false ]);
        else return redirect()->home()
                              ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}