<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Image;
use Storage;
use App\User;
use App\Comment;

class UserController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Show All resources.
    public function index( Request $request ) {
        $users = User::with('resume','comments','profileComments','rates','profileRates','likes','roles')->paginate(config('app.users_per_page'));
        return view('users.index', compact('users') );
    }

    # Show Create Form.
    public function create() {
        abort(404);
    }

    # Store the New resource in DB.
    public function store( Request $request ) {
        abort(404);
    }

    # Display the specified resource.
    public function show( Request $request, User $user ) {
        $comments = Comment::with('fromUser')->where('to_user_id',$user->id)->paginate(5);
        return view('users.show', compact('user','comments') );
    }

    # Show the form for editing the specified resource.
    public function edit( User $user ) {
        //
    }

    # Update the specified resource in storage.
    public function update( Request $request, User $user ) {
        //
    }

    # Remove the specified resource from storage
    public function destroy( User $user ) {

        if( Storage::disk('profile')->exists( $user->photo ) && Storage::disk('cover')->exists( $user->cover ) ) {

            Storage::disk('profile')->delete( $user->photo );
            Storage::disk('cover')->delete( $user->cover );
        }

        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'کاربر با موفقیت حذف شد.');
    }
}
