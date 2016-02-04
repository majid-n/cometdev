<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;
use Activation;
use Mail;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class ActivationController extends Controller
{
	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	    $this->middleware('guest');
	}

    # Make the Activation Page
    public function reactivate() {
        return view()->make('auth.activate');
    }

    # Resend or Regenerate and Send the Activation Code
    public function generateActivate( Request $request ) {

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

            if ( !$activation = Activation::exists($user) ) $activation = Activation::create($user);

            Mail::send('emails.activate', ['activation' => $activation, 'user' => $user], function ($message) use ($user) {
                $message->from(config('app.info_email'), 'کامت');
                $message->sender(config('app.info_email'), 'کامت');
                $message->to($user->email, $user->first_name." ".$user->last_name)->subject('کد فعال سازی');
                $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
            });

            return redirect('login')->withErrors('کد فعال سازی برای شما ارسال شد.');
        }

        return back()->withInput()
                     ->withErrors('ایمیلی با این مشخصات یافت نشد.');
    }

    # Activate User
    public function activate( User $user, $code ) {

        if ( Activation::complete($user, $code ) ) {

            Sentinel::login($user);
            return redirect('/')->withErrors('حساب کاربری شما فعال شد.');
        }

        return Redirect('activate')->withErrors('حساب کاربری شما غیر فعال است. جهت ارسال کد فعال سازی ایمیل خود را وارد کنید.');
    }
}
