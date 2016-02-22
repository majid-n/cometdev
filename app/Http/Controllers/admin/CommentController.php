<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{	
	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Comment $comment ) {
        $comment->delete();
        return redirect()->route('user.show',[ 'user' => $comment->to_user_id ])->with('success', 'دیدگاه با موفقیت حذف شد.');
    }
}
