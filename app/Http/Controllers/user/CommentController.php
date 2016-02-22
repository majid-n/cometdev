<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Sentinel;

class CommentController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

    	$user = Sentinel::getUser();

    	$rules = [
    	    'uid'   	=> 'required|exists:users,id|min:1',
    	    'comment' 	=> 'required|min:2',
    	];

    	$validator = Validator::make( $request->all(), $rules );

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

    	    # Create Category
    	    $comment = new Comment;
    	    $comment->text  	 = $request->comment;
    	    $comment->to_user_id = intval($request->uid);

    	    # Redirect on Success
    	    if ( $user->comments()->save($comment) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.show', [ 'user' => $comment->to_user_id ])
                                     ->with('success', 'دیدگاه شما موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Comment $comment ) {
        
        $this->authorize('destroy', $comment);

        if( $comment->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.show', [ 'user' => $comment->to_user_id ])
                                 ->with('success', 'دیدگاه شما موفقیت ثبت شد.');
        }
        
        if( $request->ajax() ) 
                    return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
