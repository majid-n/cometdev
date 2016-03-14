<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;
use App\Skill;

class SkillController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

    	$rules = [
    	    'skill' => 'required|min:3|max:20',
    	    'score' => 'required|regex:/^\d{1,2}(\.\d{1})?$/',
    	    'des'   => 'min:5|max:255'
    	];

    	$validator = Validator::make( $request->all(), $rules);

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

            # Get Login User
            $user = Sentinel::getUser();

    	    # Create Experience
    	    $skill 			= new Skill;
    	    $skill->title 	= $request->skill;
    	    $skill->score 	= floatval($request->score);
    	    $skill->des 	= $request->des;

    	    # Redirect on Success
    	    if ( $user->skills()->save($skill) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.edit', [ 'user' => $user->id ])
                                     ->with('success', 'مهارت شما با موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Skill $skill ) {
        
        $this->authorize($skill);

        if( $skill->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.edit', [ 'user' => $skill->user_id ])
                                 ->with('success', 'مهارت شما با موفقیت حذف شد.');
        }
        
        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
