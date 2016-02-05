<?php

namespace App\Http\Controllers\auth;

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

class AuthController extends Controller
{

	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Create Login Page
    public function login() {
        return view('auth.login');
    }

    # Authenticate User
    public function authenticate( Request $request ) {

        try {

            $input      = $request->all();
            $password   = $request->password;
            $email      = $request->email;
            $remember   = (boolean) $request->remember;

            $credentials = [
                'email'     => $email,
                'password'  => $password,
            ];

            $rules = [
                'email'    => 'required|email',
                'password' => 'required|alpha_num|min:5|max:20',
            ];

            $validator = Validator::make($input, $rules );

            if ( $validator->fails() ) {
                return back()->withInput()
                             ->withErrors($validator);
            }

            if ( $user = Sentinel::authenticate($credentials, $remember) ) {
                if     ( Sentinel::inRole( 'admins' ) ) return redirect()->route('admin.post.index');
                elseif ( Sentinel::inRole( 'users'  ) )  return redirect()->route('home');
            }

            return redirect()->route('login')->withInput()->with('fail', 'آدرس ایمیل یا رمز عبور شما اشتباه است.');
        }

        catch (NotActivatedException $e) {
            return redirect()->route('reactivate')->with([
                'fail'      => 'اکانت شما فعال نمی باشد.',
                'user'      => $e->getUser()
            ]);
        }

        catch (ThrottlingException $e) {
            return back()->with('fail', 'اکانت شما بلاک شد برای مدت '.$e->getDelay().' ثانیه.');
        }
    }

    # Create Register Page
    public function register() {
        return view()->make('auth.register');
    }

    # Create New User and store it in DB
    public function store( Request $request ) {

        $input = $request->all();

        $rules = [
            'first_name'       => 'required|farsi|min:2',
            'last_name'        => 'required|farsi|min:2',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|alpha_num|min:6|max:20',
            'password_confirm' => 'required|same:password',
        ];

        $validator = Validator::make($input, $rules );

        if ( $validator->fails() ) {
            return back()->withInput()
                         ->withErrors($validator);
        }

        if ( $user = Sentinel::register($input) ) {

            # Assgin role to Registred User
            $role = Sentinel::findRoleByName('users');
            $role->users()->attach($user);

            # Create Activation Code for Registered User
            $activation = Activation::create($user);

            Mail::send('emails.activate', ['activation' => $activation, 'user' => $user], function ($message) use ($user) {

                $message->from(config('app.info_email'), 'کامت');
                $message->sender(config('app.info_email'), 'کامت');
                $message->to($user->email, $user->first_name." ".$user->last_name)->subject('کد فعال سازی');
                $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
            });

            return Redirect()->route('login')->with([
                'success'   => 'اکانت شما با موفق ساخته شد.',
                'userid'    => $user->id
            ]);
        }

        return back()->withInput()
                     ->with('fail', 'خطا در اتصال به سرور، لطفا بعدا امتحان کنید.');
    }

    # Logout User from this device
    public function logout() {
        Sentinel::logout();
        return redirect()->route('home');
    }

    # Logout User from all Devices
    public function logoutEverywhere(){
        Sentinel::logout( null, true );
        return redirect()->route('home');
    }
}
