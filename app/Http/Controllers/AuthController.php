<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Sentinel;

class AuthController extends Controller
{

	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    // Define Middleware
	    $this->middleware('redirectAuth', [ 'except' => ['logout'] ]);
	}

    public function login() {
        return view()->make('auth.login');
    }

    public function postLogin( Request $request ) {

        try {
            $input      = $request->all();
            $password   = $request->password;
            $email      = $request->email;

            $credentials = [
                'email'     => $email,
                'password'  => $password,
            ];


            $rules = [
                'email'    => 'required|email',
                'password' => 'required',
            ];

            $validator = Validator::make($input, $rules);

            if ( $validator->fails() ) {
                return back()->withInput()->withErrors($validator);
            }
            
            $remember = (boolean) $request->remember;

            if ( $user = Sentinel::authenticate($credentials, $remember) ) {
                
                if ( Sentinel::inRole( 'admins' ) ) {
                    return redirect('post');
                } elseif ( Sentinel::inRole( 'users' ) ) {
                    return redirect('/');
                }
            } else {
                return redirect('login')->withInput()->withErrors('آدرس ایمیل یا پسورد شما اشتباه است.');
            }
        }

        catch (NotActivatedException $e) {
            $errors = trans('validation.account_not_active');
            // return Redirect()->to('reactivate')->with('user', $e->getUser());
        }

        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $errors = "اکانت شما بلاک شد برای مدت {$delay} ثانیه.";
        }
    }

    public function register() {
        return view()->make('auth.register');
    }

    public function postRegister( Request $request ) {
        $input = Input::all();

        $rules = [
            'first_name'       => 'required|min:2',
            'last_name'        => 'required|min:2',
            'email'            => 'required|email|unique:users',
            'mobile'           => 'required|min:11|max:11',
            'password'         => 'required',
            'password_confirm' => 'required|same:password',
            'shout'            => 'required|min:2|max:150',
            'gender'           => 'required'
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return Redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($user = Sentinel::register($input)) {

            $usersRole = Sentinel::findRoleByName('Users');
            $usersRole->users()->attach($user);

            $activation = Activation::create($user);

            $code = $activation->code;

            $sent = Mail::send('sentinel.emails.activate', compact('user', 'code'), function($m) use ($user)
            {
                $m->to($user->email)->subject('Activate Your Account');
            });

            if ($sent === 0)
            {
                return Redirect()->to('register')
                    ->withErrors('Failed to send activation email.');
            }

            return Redirect()->to('login')
                ->withSuccess(trans('validation.account_success'))
                ->with('userId', $user->getUserId());
        }

        return Redirect::to('register')
            ->withInput()
            ->withErrors('Failed to register.');
    }

    public function logout() {
        Sentinel::logout();
        return redirect('login');
    }
}
