<?php
namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rate;
use Sentinel;

class RateController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Store the New resource in DB.
    public function store( Request $request ) {
    	
    	$user = Sentinel::getUser();

        if( $user->id !== intval( $request->uid ) ) {

        	$rules = [
        	    'uid'   => 'required|exists:users,id|min:1',
        	    'score' => 'required|numeric',
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
        	    $rate = new Rate;
        	    $rate->score  	  = intval($request->score);
        	    $rate->to_user_id = intval($request->uid);

        	    # Redirect on Success
        	    if ( $user->rates()->save($rate) ) {

        	        if( $request->ajax() ) {

        	        	$userprofile = Sentinel::findById($rate->to_user_id);

        	        	return  response()->json([
        	        				'result' => false,
        	        				'score'  => $userprofile->profileRates()->avg('score'),
        	        			]);
        	        } else {
        	        	return redirect()->route('user.show', [ 'user' => $rate->to_user_id ])
        	        					 ->with('success', 'امتیاز شما موفقیت ثبت شد.');
        	        }
        	    }
        	}
        }

    	if( $request->ajax() ) 
    		return  response()->json(['result' => false]);
    	else
    		return back()->withInput()
    	             	 ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }
}
