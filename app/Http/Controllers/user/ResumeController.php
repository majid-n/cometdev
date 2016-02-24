<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resume;
use Sentinel;
use Validator;

class ResumeController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {

    	$user = Sentinel::getUser();

    	$rules = [
    	    'tel'   	=> 'required|digits_between:8,15|unique:resumes,tel',
    	    'jobtitle' 	=> 'required|min:4|max:50',
    	    'address' 	=> 'required|min:10',
    	    'bio' 		=> 'required|min:10',
    	    'duty' 		=> 'min:5|max:20',
    	    'rel' 		=> 'required|boolean',
    	    'gender' 	=> 'required|boolean',
    	    'birth' 	=> 'required|date_format:d/m/Y|before:now -1 year',
    	];

    	$messages = [
    		'gender.required' => 'لطفا جنسیت خود را انتخاب کنید.',
    		'gender.boolean'  => 'لطفا جنسیت خود را انتخاب کنید.',
    		'rel.boolean'     => 'لطفا وضعیت تاعهل خود را انتخاب کنید.',
    		'rel.required'    => 'لطفا وضعیت تاعهل خود را انتخاب کنید.',
    	]

    	$validator = Validator::make( $request->all(), $rules, $messages);

    	if ( $validator->fails() ) {

    		if( $request->ajax() ) 
                return  response()->json(['result' => false]);
    		else 
                return back()->withInput()
    	                 	 ->withErrors($validator);
    	} else {

    	    # Create Resume
    	    $resume 			= new Resume;
    	    $resume->tel 		= $request->tel;
    	    $resume->rel 		= (boolean) $request->rel;
    	    $resume->gender 	= (boolean) $request->gender;
    	    $resume->jobtitle 	= $request->jobtitle;
    	    $resume->bio 		= $request->bio;
    	    $resume->address 	= $request->address;
    	    $resume->birth 		= $request->birth;
    	    $resume->duty 		= ( !empty($request->duty) && $resume->gender ) ? $request->duty : null;

    	    # Redirect on Success
    	    if ( $user->resume()->save($resume) ) {

    	        if( $request->ajax() ) 
                    return  response()->json(['result' => true]);
    	        else 
                    return redirect()->route('user.show', [ 'user' => $user->id ])
                                     ->with('success', 'اطلاعات شخصی شما با موفقیت ثبت شد.');
    	    }
    	}

        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
    	else
            return back()->withInput()
    	                 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Request $request, Resume $resume ) {
        
        $this->authorize('destroy', $resume);

        if( $resume->delete() ) {
        	if( $request->ajax() ) 
                return  response()->json(['result' => true]);
        	else 
                return redirect()->route('user.show', [ 'user' => $resume->user_id ])
                                 ->with('success', 'اطلاعات شخصی شما با موفقیت حذف شد.');
        }
        
        if( $request->ajax() ) 
            return  response()->json(['result' => false]);
        else
            return back()->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
