<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Post;
use App\Cat;
use Image;
use Storage;

class PostController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Show All resources.
    public function index( Request $request ) {

        $posts = Post::with('likes','cat')->paginate(config('app.posts_per_page'));

        if ( $request->ajax() && $request->isMethod('get')) {

            if( $posts ) {

                if( $posts->currentPage() <= $posts->lastPage() && $posts->total() > config('app.posts_per_page') ) {

                    return  response()->json(
                                [
                                    'result'    => true,
                                    'page'      => $posts->currentPage(),
                                    'lastpage'  => $posts->lastPage(),
                                    'html'      => view('ajax.pagination', array('posts' => $posts))->render()
                                ]
                            );
                }
            }

            return  response()->json([ 'result' => false ]);
        }
        
        return view()->make('posts.index', compact('posts') );
    }

    # Display the specified resource.
    public function show( Request $request, Post $post ) {

        if ( $request->ajax() && $request->isMethod('get')) {

            if( $post ) {

                $post->increment('views');

                return  response()->json(
                            [
                                'result'      => true,
                                'modaldata'   => view('ajax.postmodaldata',  array('post' => $post))->render()
                            ]
                        );
            }

            return  response()->json([ 'result' => false ]);
        }
        
        return view()->make('posts.show', compact('post') );
    }
}
