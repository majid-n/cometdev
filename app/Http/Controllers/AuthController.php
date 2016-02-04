<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;
use Activation;
use Mail;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class AuthController extends Controller
{

	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	    $this->middleware('guest', [ 'except' => ['logout'] ]);
	}

    # Create Login Page
    public function login() {
        return view()->make('auth.login');
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
                'password' => 'required',
            ];

            $messsages = [
                'email.required'    =>'لطفا ایمیل خود را وارد کنید.',
                'email.email'       =>'لطفا ایمیل خود را به درستی وارد کنید.',
                'password.required' =>'لطفا رمز عبور خود را وارد کنید.',
            ];

            $validator = Validator::make($input, $rules, $messsages);

            if ( $validator->fails() ) {
                return back()->withInput()
                             ->withErrors($validator);
            }

            if ( $user = Sentinel::authenticate($credentials, $remember) ) {
                if     ( Sentinel::inRole( 'admins' ) ) return redirect('post');
                elseif ( Sentinel::inRole( 'users'  ) )  return redirect('/');
            }

            return redirect('login')->withInput()->withErrors('آدرس ایمیل یا رمز عبور شما اشتباه است.');
        }

        catch (NotActivatedException $e) {
            return Redirect('activate')->with('user', $e->getUser());
        }

        catch (ThrottlingException $e) {
            return back()->withErrors('اکانت شما بلاک شد برای مدت '.$e->getDelay().' ثانیه.');
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
            'password'         => 'required',
            'password_confirm' => 'required|same:password',
        ];

        $messsages = [
            'first_name.required'       => 'لطفا نام خود را وارد کنید.',
            'first_name.farsi'          => 'لطفا در نام خود فقط از حروف فارسی استفاده کنید.',
            'first_name.min'            => 'نام شما باید حداقل دارای :min حرف باشد.',
            'last_name.required'        => 'لطفا نام خانوادگی خود را وارد کنید.',
            'last_name.farsi'           => 'لطفا در نام خانوادگی خود فقط از حروف فارسی استفاده کنید.',
            'last_name.min'             => 'نام خانوادگی شما باید حداقل دارای :min حرف باشد.',
            'email.required'            => 'لطفا ایمیل خود را وارد کنید.',
            'email.email'               => 'لطفا ایمیل خود را به درستی وارد کنید.',
            'email.unique'              => 'ایمیل شما قبلا استفاده شده است.',
            'password.required'         => 'لطفا رمز عبور خود را وارد کنید.',
            'password_confirm.required' => 'لطفا تائید رمز عبور خود را وارد کنید.',
            'password_confirm.same'     => 'لطفا رمز عبور و تائیدیه آن را به صورت یکسان وارد کنید.',
        ];

        $validator = Validator::make($input, $rules, $messsages);

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

            return Redirect('login')->withErrors('اکانت شما با موفق ساخته شد.')
                                    ->with('userid', $user->id);
        }

        return back()->withInput()
                     ->withErrors('خطا در اتصال به سرور، لطفا بعدا امتحان کنید.');
    }

    # Logout User
    public function logout() {
        Sentinel::logout();
        return redirect('login');
    }
}
