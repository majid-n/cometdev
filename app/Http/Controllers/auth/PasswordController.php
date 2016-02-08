<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;
use Reminder;
use Mail;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class PasswordController extends Controller
{
    
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

	# Make Forgot Password Page
	public function forgot() {
	    return view('auth.forgot');
	}

	# Generate reset Password Link and send it by Email
	public function prepareReset(Request $request) {

	    $input = $request->all();

	    $credentials = [
	        'email' => $request->email,
	    ];

	    $rules = [
	        'email' => 'required|email|exists:users,email',
	    ];

	    $validator = Validator::make( $input, $rules );

	    if ( $validator->fails() ) {
	        return back()->withInput()
	                     ->withErrors($validator);
	    }

	    if ( $user = Sentinel::findByCredentials($credentials) ) {

	    	if( !$user->inRole('admins') ) {

	    		if ( !$reminder = Reminder::exists($user) ) $reminder = Reminder::create($user);

	    		Mail::send('emails.forgot', ['reminder' => $reminder, 'user' => $user], function ($message) use ($user) {
	    		    $message->from(config('app.info_email'), 'کامت');
	    		    $message->sender(config('app.info_email'), 'کامت');
	    		    $message->to($user->email, $user->first_name." ".$user->last_name)->subject('تغییر رمز عبور');
	    		    $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
	    		});

	    		return redirect()->route('login')
	    						 ->with('success', 'ایمیل تغییر و ریست رمز عبور ارسال شد.');

	    	}else{

	    		return back()->withInput()
	    		             ->with('fail', 'بازیابی کلمه عبور برای این حساب کاربری مقدور نمی باشد.');
	    	}
	    }

	    return back()->withInput()
	                 ->with('fail', 'ایمیلی با این مشخصات یافت نشد.');
	}

	# Make Reset Password Page
	public function reset( User $user, $code ) {

		if( !$user->inRole('admins') ) {

			if( !empty( $code ) ) return view('auth.reset',compact('code','user'));
			return redirect()->route('forgot')
							 ->with('fail', 'کد امنیتی جهت بازیابی کلمه عبور صحیح نمی باشد.');
		}

		return redirect()->route('forgot')
					     ->with('fail', 'بازیابی کلمه عبور برای این حساب کاربری مقدور نمی باشد.');
	}

	# Reset Password
	public function resetPassword( Request $request ){

	    $input = $request->all();

	    $credentials = [
	        'email' => $request->email,
	    ];

	    $rules = [
	        'email'             => 'required|email|exists:users,email',
	        'password'          => 'required|alpha_num|min:6|max:20',
	        'password_confirm'  => 'required|same:password',
	        'code'              => 'required'
	    ];

	    $messsages = [
	        'code.required'             => 'خطای امنیتی. لطفا عملیات تغییر رمز عبور را مجددا انجام دهید.'
	    ];

	    $validator = Validator::make($input, $rules, $messsages);

	    if ( $validator->fails() ) {
	        return back()->withInput()
	                     ->withErrors($validator);
	    }

	    if ( $user = Sentinel::findByCredentials($credentials) ) {

	    	if( !$user->inRole('admins') ) {

		        if ( Reminder::complete($user, $request->code, $request->password) ) {

		        	Mail::send('emails.reset', ['password' => $request->password, 'user' => $user], function ($message) use ($user) {
		        	    $message->from(config('app.info_email'), 'کامت');
		        	    $message->sender(config('app.info_email'), 'کامت');
		        	    $message->to($user->email, $user->first_name." ".$user->last_name)->subject('رمز عبور با موفقیت تغییر یافت');
		        	    $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
		        	});

		        	return redirect()->route('login')
		        					 ->with('success', 'عملیات تغییر رمز عبور با موفقیت انجام شد.');
		        }

	    	} else {

	    		return redirect()->route('forgot')
					     		 ->with('fail', 'بازیابی کلمه عبور برای این حساب کاربری مقدور نمی باشد.');
	    	}
	    }

	    return back()->withInput()
	                 ->with('fail', 'خطای امنیتی. لطفا عمیات تغییر رمز عبور را مجددا انجام دهید.');
	}
}
