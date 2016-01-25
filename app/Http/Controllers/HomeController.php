<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Like;
use App\Post;

class HomeController extends Controller
{
    public function index() {

        $title         = 'گروه طراحی و توسعه کامت';
    	$TotalLikes    = Like::all()->count();
    	$TotalPosts    = Post::all()->count();
    	$TotalNewPosts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
    	$Posts         = Post::paginate(config('app.POSTS_LIMIT'));
        $Page          = $Posts->currentPage();
    	$TotalPage     = ceil( $TotalPosts/config('app.POSTS_LIMIT') );

    	return view('index',compact('TotalLikes','TotalPosts','TotalNewPosts','Posts','TotalPage','Page','title'));
    }

    public function likePost(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {

            if( $request->has('pid') ) {

                $Post       = new Post;
                $Post->id   = intval( $request->input('pid') );

                if( $Post->isLiked() > 0 ) {

                    $isDeleted = Like::where([
                                    ['post_id','=',$Post->id],
                                    ['ip','=',$request->ip()]
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
}

    // $Admins         = Team::Admins("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");
    // $Members        = Team::Members("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");