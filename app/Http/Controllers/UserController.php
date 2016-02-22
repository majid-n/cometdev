<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Comment;

class UserController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Display the specified resource.
    public function show( Request $request, User $user ) {

        $collection     = collect([$user->edus, $user->xps]);
        $collapsed      = $collection->collapse();
        $timelineItems  = $collapsed->sortBy( function($item) { return $item->startyear; } );
        $comments       = Comment::with('fromUser')->where('to_user_id',$user->id)->paginate(5);
        return view('users.show', compact('user','comments','timelineItems') );
    }
}
