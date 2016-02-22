<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use App\User;

class UserController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
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
