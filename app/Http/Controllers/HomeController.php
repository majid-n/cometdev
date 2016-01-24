<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Time;
use App\Like;
use App\Post;


class HomeController extends Controller
{
    public function index() {

        $Page          = 1;
    	$TotalLikes    = Like::all()->count();
    	$TotalPosts    = Post::all()->count();
    	$TotalNewPosts = Post::where('CURRENT_TIMESTAMP() <= TIMESTAMP(time + INTERVAL 1 MONTH)');
    	$Posts         = Post::paginate(config('app.POSTS_LIMIT'));
    	$TotalPage     = ceil( $TotalPosts/config('app.POSTS_LIMIT') );

    	return view('index',compact('TotalLikes','TotalPosts','TotalNewPosts','Posts','TotalPage','Page'));
    }

    public function likePost() {

        // if( Request::ajax() && Request::isMethod('post') ) {
            // if( $request->has('pid') ) {

                // $Post     = new Post();
                // $Post->id = intval( $_POST['pid'] );

                // if( is_numeric($Post->id) && $Post->id !== 0 ) {

                //     $Like = new Like();
                //     $Like->post_id  = $Post->id;
                //     $like->ip       = request()->ip();
                //     $Like->likedat  = '2015-10-05 22:00:00';

                //     if($Like->save()) {

                //         $totalPostLikes = $Post->TotalLikes();
                //         $totalLikes     = Like::all()->count();

                //         return response()->json([
                //                     'result' => true,
                //                     'totalPostLikes' => $totalPostLikes,
                //                     'totalLikes' => $totalLikes
                //                 ]);
                //     }
                    // if( $Post->Like() ) {

                        
                    // }
                // }
            // }
        // }
        if (Request::ajax()) {
           return Response::json([ 'result' =>  7]);
        }

            // $request->input('pid')
    }
}

    // $Admins         = Team::Admins("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");
    // $Members        = Team::Members("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");