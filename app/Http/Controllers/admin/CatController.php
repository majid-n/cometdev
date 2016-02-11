<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cat;

class CatController extends Controller
{

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Show All resources.
    public function index() {
        $cats = Cat::paginate( config('app.cats_per_page') );
        return view( 'cats.index', compact('cats') );
    }

    # Show Create Form.
    public function create() {
        $cats = Cat::where( 'parent', 0 )->get();
        return view( 'cats.create', compact('cats') );
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'cat_id'            => 'required|numeric',
        ];

        $messeages = [
            'cat_id.required' => 'از لیست دسته ها یکی را انتخاب کنید.',
        ];

        $validator = Validator::make( $request->all(), $rules, $messeages );

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

            # Create Category
            $cat = new Cat;
            $cat->title            = $request->title;
            $cat->parent           = $request->cat_id;

            # Redirect on Success
            if ( $cat->save() ) {
                return redirect()->route('admin.cat.index')->with('success', 'دسته با موفقیت ثبت شد.');
            }
        }

        return back()->withInput()
                     ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Display the specified resource.
    public function show( Request $request, Cat $cat ) {
        abort(404);
    }

    # Show the form for editing the specified resource.
    public function edit( Cat $cat ) {
        $categories = Cat::where( 'parent', 0 )->get();
        return view('cats.edit', compact('cat','categories') );
    }

    # Update the specified resource in storage.
    public function update( Request $request, Cat $cat ) {

        $rules = [
            'title'             => 'required|farsi|min:5|max:80',
            'cat_id'            => 'required|numeric',
        ];

        $messeages = [
            'cat_id.required' => 'از لیست دسته ها یکی را انتخاب کنید.',
        ];

        $validator = Validator::make( $request->all(), $rules, $messeages );

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

            # Create Category
            $cat->title            = $request->title;
            $cat->parent           = $request->cat_id;

            # Redirect on Success
            if ( $cat->save() ) {
                return redirect()->route('admin.cat.index')->with('success', 'دسته با موفقیت ثبت شد.');
            }
        }

        return back()->withInput()
                     ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Cat $cat ) {
        $cat->delete();
        return redirect()->route('admin.cat.index')->with('success', 'دسته با موفقیت حذف شد.');
    }
}
