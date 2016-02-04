<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;
use Reminder;
use Mail;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class PasswordController extends Controller
{
    
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	    $this->middleware('guest');
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

	    $messsages = [
	        'email.required'            => 'لطفا ایمیل خود را وارد کنید.',
	        'email.email'               => 'لطفا ایمیل خود را به درستی وارد کنید.',
	        'email.exists'              => 'ایمیل وارد شده ثبت نامنشده است.',
	    ];

	    $validator = Validator::make($input, $rules, $messsages);

	    if ( $validator->fails() ) {
	        return back()->withInput()
	                     ->withErrors($validator);
	    }

	    if ( $user = Sentinel::findByCredentials($credentials) ) {

	        if ( !$reminder = Reminder::exists($user) ) $reminder = Reminder::create($user);

	        Mail::send('emails.forgot', ['reminder' => $reminder, 'user' => $user], function ($message) use ($user) {
	            $message->from(config('app.info_email'), 'کامت');
	            $message->sender(config('app.info_email'), 'کامت');
	            $message->to($user->email, $user->first_name." ".$user->last_name)->subject('تغییر رمز عبور');
	            $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
	        });

	        return redirect('login')->withErrors('ایمیل تغییر و ریست رمز عبور ارسال شد.');
	    }

	    return back()->withInput()
	                 ->withErrors('ایمیلی با این مشخصات یافت نشد.');
	}

	# Make Reset Password Page
	public function reset( $code ) {

		if( !empty( $code ) ) return view('auth.reset',compact('code'));

		return redirect('forgot')->withErrors('کد امنیتی جهت ریست رمز عبور صحیح نمی باشد.');
	}

	# Reset Password
	public function resetPassword( Request $request ){

	    $input = $request->all();

	    $credentials = [
	        'email' => $request->email,
	    ];

	    $rules = [
	        'email'             => 'required|email|exists:users,email',
	        'password'          => 'required',
	        'password_confirm'  => 'required|same:password',
	        'code'              => 'required'
	    ];

	    $messsages = [
	        'email.required'            => 'لطفا ایمیل خود را وارد کنید.',
	        'email.email'               => 'لطفا ایمیل خود را به درستی وارد کنید.',
	        'email.exists'              => 'ایمیل وارد شده ثبت نامنشده است.',
	        'password.required'         => 'لطفا رمز عبور خود را وارد کنید.',
	        'password_confirm.required' => 'لطفا تائید رمز عبور خود را وارد کنید.',
	        'password_confirm.same'     => 'لطفا رمز عبور و تائیدیه آن را به صورت یکسان وارد کنید.',
	        'code.required'             => 'خطای امنیتی. لطفا عمیات تغییر رمز عبور را مجددا انجام دهید.'
	    ];

	    $validator = Validator::make($input, $rules, $messsages);

	    if ( $validator->fails() ) {
	        return back()->withInput()
	                     ->withErrors($validator);
	    }

	    if ( $user = Sentinel::findByCredentials($credentials) ) {

	        if ( Reminder::complete($user, $request->code, $request->password) ) {

	        	Mail::send('emails.reset', ['password' => $request->password, 'user' => $user], function ($message) use ($user) {
	        	    $message->from(config('app.info_email'), 'کامت');
	        	    $message->sender(config('app.info_email'), 'کامت');
	        	    $message->to($user->email, $user->first_name." ".$user->last_name)->subject('رمز عبور با موفقیت تغییر یافت');
	        	    $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
	        	});

	        	return redirect('login')->withErrors('عملیات تغییر رمز عبور با موفقیت انجام شد.');

	        }
	    }

	    return back()->withInput()
	                 ->withErrors('خطای امنیتی. لطفا عمیات تغییر رمز عبور را مجددا انجام دهید.');
	}
}
