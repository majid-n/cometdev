<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Storage;
use Sentinel;

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

    # Display the specified resource.
    public function show( Request $request, User $user ) {
        $collection     = collect([$user->edus, $user->xps]);
        $collapsed      = $collection->collapse();
        $timelineItems  = $collapsed->sortByDesc( function($item) { return $item->startyear; } );
        $comments       = $user->profileComments()->paginate(5);
        return view('users.show', compact('user','comments') );
    }

    # Show the form for editing the specified resource.
    public function edit( User $user ) {
        $comments = $user->comments()->paginate(5);
        return view('users.edit', compact('user','comments') );
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
