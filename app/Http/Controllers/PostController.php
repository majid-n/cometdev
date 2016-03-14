<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Post;
use App\Cat;
use App\like;
use Image;
use Storage;
use Sentinel;

class PostController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Show All resources.
    public function index( Request $request ) {

        $posts = Post::with('likes','cat')->paginate(config('app.posts_per_page'));

        if ( $request->ajax() ) {

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
        
        return view('posts.index', compact('posts') );
    }

    # Display the specified resource.
    public function show( Request $request, Post $post ) {

        if ( $request->ajax() ) {

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
        
        return view('posts.show', compact('post') );
    }

    # Show Create Form.
    public function create() {
        $cats = Cat::orderBy('parent','asc')->get();
        return view('posts.create', compact('cats'));
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'description'       => 'required|min:5',
            'smalldescription'  => 'required|min:5',
            'link'              => 'active_url|min:5|max:255',
            'cat_id'            => 'required|numeric|min:1|exists:cats,id',
            'image'             => 'required|mimes:jpeg,jpg,png'
        ];

        $messeages = [
            'cat_id.required' => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.numeric'  => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.min'      => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.exists'   => 'دسته مورد نظر موجود نمی باشد.',
            'image.required'  => 'لطفا یک عکس برای پست انتخاب کنید.'
        ];

        $validator = Validator::make( $request->all(), $rules, $messeages );

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

            if( $request->file('image')->isValid() ) {

                $image      = $request->file('image');                                                         # Image Object
                $filename   = $image->getClientOriginalName();                                                 # Image File Name
                $thumbname  = explode('.', $filename)[0] . '_thumb.' . $image->getClientOriginalExtension();   # Thumb File Name
                $savedimg   = $image->move( storage_path('app/portfolio') , $filename );                       # Saved Image Address

                # Save Thumb
                Image::make($savedimg)
                            ->resize(300, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })
                            ->save(storage_path('app/portfolioThumb/'). $thumbname);

                # Create Post
                $post = new Post;
                $post->title            = $request->title;
                $post->description      = $request->description;
                $post->smalldescription = $request->smalldescription;
                $post->link             = $request->link;
                $post->cat_id           = $request->cat_id;
                $post->image            = $filename;
                $post->thumb            = $thumbname;

                # Redirect on Success
                if ( $post->save() ) {
                    return redirect()->route('admin.post.index')->with('success', 'محصول با موفقیت ثبت شد.');
                }
            } 
        }

        return back()->withInput()
                     ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Show the form for editing the specified resource.
    public function edit( Post $post ) {
        $cats = Cat::orderBy('parent','asc')->get();
        return view('posts.edit', compact('post','cats') );
    }

    # Update the specified resource in storage.
    public function update( Request $request, Post $post ) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'description'       => 'required|min:5',
            'smalldescription'  => 'required|min:5',
            'link'              => 'active_url|min:5|max:255',
            'cat_id'            => 'required|numeric|min:1|exists:cats,id',
            'views'             => 'required|numeric',
            'active'            => 'boolean'
        ];

        $messeages = [
            'cat_id.required' => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.numeric'  => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.min'      => 'از لیست دسته ها یکی را انتخاب کنید.',
            'cat_id.exists'   => 'دسته مورد نظر موجود نمی باشد.'
        ];

        $validator = Validator::make( $request->all(), $rules, $messeages);

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

                # Create Post
                $post->title            = $request->title;
                $post->description      = $request->description;
                $post->smalldescription = $request->smalldescription;
                $post->link             = ( !empty($request->link) ) ? $request->link : null;
                $post->cat_id           = $request->cat_id;
                $post->views            = $request->views;
                $post->active           = ( !empty($request->active) ) ? $request->active : 0;

                # Redirect on Success
                if ( $post->save() ) {
                    return redirect()->route('admin.post.index')->with('success', 'محصول با موفقیت ثبت شد.');
                }
        }

        return back()->withInput()
                     ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Post $post ) {

        if( Storage::disk('portfolio')->exists( $post->image ) && Storage::disk('portfolioThumb')->exists( $post->thumb ) ) {
            Storage::disk('portfolio')->delete( $post->image );
            Storage::disk('portfolioThumb')->delete( $post->thumb );
        }

        $post->delete();
        return redirect()->route('admin.post.index')->with('success', 'محصول با موفقیت حذف شد.');
    }

    # Like each Post from Portfiolio Section
    public function like( Request $request, Post $post ) {

        # Get Login User
        $user = Sentinel::getUser();

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
        
        if( $request->ajax() ) return response()->json([ 'result' =>  false ]);
        else return redirect()->home()
                              ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}