<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Like;
use App\Post;

class AjaxController extends Controller
{
    # Like each Post from Portfiolio Section
    public function LikePost(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {

            if( $request->has('pid') ) {

                $Post       = new Post;
                $Post->id   = intval( $request->input('pid') );

                if( $Post->isLiked() > 0 ) {
                    # When User Liked this Post
                    $isDeleted = Like::where([
                                    ['post_id','=',$Post->id],
                                    ['ip','=',$request->ip()],
                                ])->delete();

                    if( $isDeleted ) {

                        $totalPostLikes = Like::where('post_id', '=', $Post->id)->count();
                        $totalLikes     = Like::all()->count();
                        if( $totalPostLikes === 0 ) $totalPostLikes = ''; 

                        return  response()->json(
                                    [
                                        'result' => true,
                                        'status' => 'unlike',
                                        'totalPostLikes' => $totalPostLikes,
                                        'totalLikes' => $totalLikes
                                    ]
                                );
                    }
                }else{
                    # When User didn't Like this Post before
                    $Like           = new Like;
                    $Like->ip       = $request->ip();
                    $Like->post_id  = $Post->id;

                    if( $Like->save() ) {

                        $totalPostLikes = Like::where('post_id', '=', $Like->post_id)->count();
                        $totalLikes     = Like::all()->count();

                        return  response()->json(
                                    [
                                        'result' => true,
                                        'status' => 'like',
                                        'totalPostLikes' => $totalPostLikes,
                                        'totalLikes' => $totalLikes
                                    ]
                                );
                    }
                }
            }  
        }
            
        return response()->json([ 'result' =>  false ]);
    }

    # Portfolio Pagination
    public function PaginatePost(Request $request) {
        
        if ( $request->ajax() && $request->isMethod('get')) {

                $Posts = Post::paginate(config('app.POSTS_LIMIT'));

                if( $Posts->currentPage() <= $Posts->lastPage() && $Posts->total() > config('app.POSTS_LIMIT') ) {

                    return  response()->json(
                                [
                                    'result'    => true,
                                    'page'      => $Posts->currentPage(),
                                    'lastpage'  => $Posts->lastPage(),
                                    'html'      => view('layouts.pagination', array('Posts' => $Posts))->render()
                                ]
                            );
                }
        }

        return  response()->json([ 'result' => false ]);
    }
}