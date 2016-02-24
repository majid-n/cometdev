<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Xp;
use Validator;
use Sentinel;

class XpController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

    	$user = Sentinel::getUser();

    	$rules = [
    	    'startyear' => 'required|date_format:d/m/Y|before:tomorrow',
    	    'endyear' 	=> 'required|date_format:d/m/Y|before:startyear',
    	    'company'   => 'required|min:3|max:70',
    	];

    	$validator = Validator::make( $request->all(), $rules);

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

    	    # Create Experience
    	    $xp 			= new Xp;
    	    $xp->startyear 	= $request->startyear;
    	    $xp->endyear 	= $request->endyear;
    	    $xp->company 	= $request->company;

    	    # Redirect on Success
    	    if ( $user->xps()->save($xp) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.show', [ 'user' => $user->id ])
                                     ->with('success', 'سابقه کاری شما با موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Xp $xp ) {
        
        $this->authorize('destroy', $xp);

        if( $xp->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.show', [ 'user' => $xp->user_id ])
                                 ->with('success', 'سابقه کاری شما با موفقیت حذف شد.');
        }
        
        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
