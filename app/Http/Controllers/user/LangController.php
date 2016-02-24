<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lang;
use Sentinel;
use Validator;

class LangController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

    	$user = Sentinel::getUser();

    	$rules = [
    	    'lang'   	=> 'required|farsi|min:3|max:20',
    	    'score' 	=> 'required|regex:/^\d{1,2}(\.\d{1})?$/',
    	];

    	$validator = Validator::make( $request->all(), $rules);

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

    	    # Create Language
    	    $lang 			= new Lang;
    	    $lang->title 	= $request->lang;
    	    $lang->score    = floatval($request->score);

    	    # Redirect on Success
    	    if ( $user->langs()->save($lang) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.show', [ 'user' => $user->id ])
                                     ->with('success', 'زبان خارجی با موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Lang $lang ) {
        
        $this->authorize('destroy', $lang);

        if( $lang->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.show', [ 'user' => $lang->user_id ])
                                 ->with('success', 'زبان خارجی با موفقیت حذف شد.');
        }
        
        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
