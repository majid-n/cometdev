<?php

namespace App\Http\Controllers;

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
        abort(404);
    }

    # Display the specified resource.
    public function show( Request $request, User $user ) {

        $collection     = collect([$user->edus, $user->xps]);
        $collapsed      = $collection->collapse();
        $timelineItems  = $collapsed->sortBy( function($item) { return $item->startyear; } );
        $comments       = Comment::with('fromUser')->where('to_user_id',$user->id)->paginate(5);
        return view('users.show', compact('user','comments','timelineItems') );
    }

    # Show the form for editing the specified resource.
    public function edit( User $user ) {
        abort(404);
    }

    # Update the specified resource in storage.
    public function update( Request $request, User $user ) {
        abort(404);
    }

    # Remove the specified resource from storage
    public function destroy( User $user ) {
        abort(404);
    }
}
