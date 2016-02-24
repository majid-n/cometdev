<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Edu;
use Sentinel;
use Validator;

class EduController extends Controller
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
    	    'degree' 	=> 'required|min:3|max:100',
    	    'uni' 		=> 'required|min:3|max:70',
    	    'uniscore' 	=> 'required|regex:/^\d{1,2}(\.\d{2})?$/',
    	];

    	$validator = Validator::make( $request->all(), $rules);

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

    	    # Create Education
    	    $edu 			= new Edu;
    	    $edu->startyear = $request->startyear;
    	    $edu->endyear 	= $request->endyear;
    	    $edu->degree 	= $request->degree;
    	    $edu->uni 		= $request->uni;
    	    $edu->score 	= floatval($request->uniscore);

    	    # Redirect on Success
    	    if ( $user->edus()->save($edu) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.show', [ 'user' => $user->id ])
                                     ->with('success', 'مدرک تحصیلی شما با موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Edu $edu ) {
        
        $this->authorize('destroy', $edu);

        if( $edu->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.show', [ 'user' => $edu->user_id ])
                                 ->with('success', 'مدرک تحصیلی شما با موفقیت حذف شد.');
        }
        
        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
