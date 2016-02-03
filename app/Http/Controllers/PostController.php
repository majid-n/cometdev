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
        // Define Middleware
        $this->middleware('role:Admins', [ 'except' => ['show'] ]);
    }

    # Show All resources.
    public function index() {
        $posts = Post::with('likes','cat')->paginate(config('app.posts_per_page'));
        return view()->make('posts.index', compact('posts') );
    }

    # Show Create Form.
    public function create() {
        $cats = collect(Cat::lists('title', 'id')->toArray())->prepend('دســـته را انتخاب کنید','')->all();
        return view()->make('posts.create', compact('cats'));
    }

    # Store the New resource in DB.
    public function store(Request $request) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'description'       => 'required|min:5',
            'smalldescription'  => 'required|min:5',
            'link'              => 'required|active_url',
            'cat_id'            => 'required|numeric',
            'image'             => 'required|mimes:jpeg,jpg,png'
        ];

        $messsages = [
            'title.required'                =>'لطفا عنوان را وارد کنید.',
            'title.min'                     =>'عنوان باید حداقل دارای :min حرف باشد.',
            'title.max'                     =>'عنوان باید حداکثر دارای :max عدد باشد.',
            'title.farsi'                   =>'برای عنوان از حروف فارسی استفاده کنید.',
            'description.required'          =>'لطفا توضیحات کامل را وارد کنید.',
            'description.min'               =>'توضیحات کامل باید حداقل دارای :min حرف باشد.',
            'smalldescription.required'     =>'لطفا توضیحات کامل را وارد کنید.',
            'smalldescription.min'          =>'توضیحات کامل باید حداقل دارای :min حرف باشد.',
            'link.required'                 =>'لطفا آدرس لینک را وارد کنید.',
            'link.active_url'               =>'لطفا آدرس لینک را به درستی وارد کنید.',
            'cat_id.required'               =>'لطفا دسته مورد نظر را انتخاب کنید.',
            'cat_id.numeric'                =>'خطا در انتخاب دسته.',
            'image.required'                =>'تصویر را انتخاب کنید.',
            'image.mimes'                   =>'تصویر باید با فرمت Jpeg|JPG|PNG باشد.',
        ];

        $validator = Validator::make( $request->all(), $rules, $messsages);

        if ( $validator->fails() ) {

            $errors = $validator->messages();

            return back()->withInput()
                         ->withErrors($errors);

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
                    return Redirect('/post')->with('success','محصول با موفقیت ثبت شد.');
                }
            } 
        }

        return back()->withInput()
                     ->with('fail','محصول با موفقیت ثبت شد.');
    }

    # Display the specified resource.
    public function show(Post $post) {
        return view()->make('posts.show', compact('post') );
    }

    # Show the form for editing the specified resource.
    public function edit(Post $post) {
        $cats = collect(Cat::lists('title', 'id')->toArray())->prepend('دســـته را انتخاب کنید','')->all();
        return view()->make('posts.edit', compact('post','cats') );
    }

    # Update the specified resource in storage.
    public function update(Request $request, Post $post) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'description'       => 'required|min:5',
            'smalldescription'  => 'required|min:5',
            'link'              => 'active_url',
            'cat_id'            => 'required|numeric',
            'views'             => 'required|numeric',
            'active'            => 'regex:/[0-1]{1}/',
        ];

        $messsages = [
            'title.required'                =>'لطفا عنوان را وارد کنید.',
            'title.min'                     =>'عنوان باید حداقل دارای :min حرف باشد.',
            'title.max'                     =>'عنوان باید حداکثر دارای :max عدد باشد.',
            'title.farsi'                   =>'برای عنوان از حروف فارسی استفاده کنید.',
            'description.required'          =>'لطفا توضیحات کامل را وارد کنید.',
            'description.min'               =>'توضیحات کامل باید حداقل دارای :min حرف باشد.',
            'smalldescription.required'     =>'لطفا توضیحات کامل را وارد کنید.',
            'smalldescription.min'          =>'توضیحات کامل باید حداقل دارای :min حرف باشد.',
            'link.active_url'               =>'لطفا آدرس لینک را به درستی وارد کنید.',
            'cat_id.required'               =>'لطفا دسته مورد نظر را انتخاب کنید.',
            'cat_id.numeric'                =>'خطا در انتخاب دسته.',
            'views.required'                =>'لطفا تعداد بازدید را وارد کنید.',
            'views.numeric'                 =>'لطفا تعداد بازدید را به عدد وارد کنید.',
            'active.regex'                  =>'خطا در گزینه فعال سازی.',
        ];

        $validator = Validator::make( $request->all(), $rules, $messsages);

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
                    return Redirect('/post')->with('success','محصول با موفقیت ثبت شد.');
                }
        }

        return back()->withInput()
                     ->with('fail','محصول با موفقیت ثبت شد.');
    }

    # Remove the specified resource from storage
    public function destroy(Post $post) {
        Storage::disk('portfolio')->delete( $post->image );
        Storage::disk('portfolioThumb')->delete( $post->thumb );
        $post->delete();
        return redirect('/post')->with('success','محصول با موفقیت ثبت شد.');
    }
}
