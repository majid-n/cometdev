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

    # Dependency Injection & Controllers
    public function __construct(){
        // Define Middleware
    }

    # Show All resources.
    public function index() {
        $posts = Post::with('likes','cat')->get();
        return view()->make('posts.index', compact('posts') );
    }

    # Show Create Form.
    public function create() {
        $totalnewposts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
        $cats          = collect(Cat::lists('title', 'id')->toArray())->prepend('دســـته را انتخاب کنید','')->all();
        return view()->make('posts.create', compact('totalnewposts','cats'));
    }

    # Store the New resource in DB.
    public function store(Request $request) {

        $rules = array(
            'title'             => 'required|min:5|max:80',
            'description'       => 'required|min:5',
            'smalldescription'  => 'required|min:5',
            'link'              => 'required|active_url',
            'cat_id'            => 'required|numeric',
            'image'             => 'required|mimes:jpeg,jpg,png'
        );

        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) {

            $errors = $validator->messages();

            return redirect()->back()
                             ->withInput()
                             ->withErrors($errors);

        } else {

            $image      = $request->file('image');                                                          # Image Object
            $filename   = $image->getClientOriginalName();                                                  # Image File Name
            $thumbname  = explode('.', $filename)[0] . '_thumb.' . $image->getClientOriginalExtension();    # Thumb File Name
            $savedimg   = $image->move( storage_path('app/portfolio') , $filename );                        # Saved Image Address

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
                return Redirect('/post')->with('success','محصول با موفقیت ثبت شد.');
            }
        }

        # add Error Redirect
    }

    # Display the specified resource.
    public function show(Post $post) {
        return view()->make('posts.show', compact('post') );
    }

    # Show the form for editing the specified resource.
    public function edit(Post $post) {
        return view()->make('posts.edit', compact('post') );
    }

    # Update the specified resource in storage.
    public function update(Request $request, Post $post) {
        //
    }

    # Remove the specified resource from storage
    public function destroy(Post $post) {
        Storage::disk('portfolio')->delete( $post->image );
        Storage::disk('portfolioThumb')->delete( $post->thumb );
        $post->delete();
        return redirect('/post')->with('success','محصول با موفقیت ثبت شد.');
    }
}
