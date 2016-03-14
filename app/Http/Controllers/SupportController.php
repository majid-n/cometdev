<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;
use App\Support;

class SupportController extends Controller
{   

    # Dependency Injection & Controllers & Middlewares
    public function __construct(){
        # Define Middleware
    }

    # Show All resources.
    public function index( Request $request ) {
        $supports = Support::orderBy('seen','asc')->paginate(config('app.supports_per_page'));
        return view('supports.index', compact('supports') );
    }

    # Show the form for reply to the specified resource.
    public function edit( Support $support ) {
        return view('supports.reply', compact('support') );
    }
    
    # Store the New resource in DB.
    public function store( Request $request ) {

        if(  $request->ajax() ) parse_str( $request->data , $input );
        else $input = $request->all();

        $rules = [
            'fullname'  => 'required|farsi|min:3|max:150',
            'email'     => 'required|email|min:5|max:150',
            'tel'       => 'required|digits_between:8,15',
            'des'       => 'required|min:10|max:500'
        ];

        $validator = Validator::make( $input , $rules );

        if ( $validator->fails() ) {

            if(  $request->ajax() ) 
                return response()->json([
                        'result'    => 'error',
                        'errors'    => $validator->errors(),
                    ]);
            else
                return back()->withInput()
                             ->withErrors($validator);

        } else {

            $supportticket = Support::where('ip', $request->ip())
                                ->whereRaw('UTC_TIMESTAMP() <= TIMESTAMP(created_at + INTERVAL '.config('app.support_throttle').')')
                                ->count();

            if( $supportticket > 0 ) {

                if(  $request->ajax() )
                    return response()->json([ 'result' => 'wait' ]);
                else
                    return redirect()->home()->with('fail', 'شما لحظاتی پیش یک پیام با موفقیت ارسال کرده اید، لطفا بعدا تلاش کنید.');                    
            } else {

                # Create Support
                $support = new Support;
                $support->fullname          = $input['fullname'];
                $support->email             = $input['email'];
                $support->tel               = $input['tel'];
                $support->description       = $input['des'];
                $support->ip                = $request->ip();

                # Redirect on Success
                if ( $support->save() ) {

                    Mail::send('emails.support', ['support' => $support], function ($message) use ($support) {
                        $message->from(config('app.info_email'), 'کامت');
                        $message->sender(config('app.info_email'), 'کامت');
                        $message->to($support->email, $support->fullname)->subject('گروه طراحی و توسعه کامت');
                        $message->replyTo(config('app.support_email'), 'کامت');
                    });

                    if(  $request->ajax() )
                        return response()->json([ 'result' => 'success' ]);
                    else
                        return redirect()->home()->with('success', 'پیام شما با موفقیت ثبت شد.');
                }
            }
        }

        if(  $request->ajax() )
            return response()->json([ 'result' => 'fail' ]);
        else
            return back()->withInput()
                         ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Update the specified resource in storage.
    public function update( Request $request, Support $support ) {

        $rules = [
            'replymsg' => 'required|min:5'
        ];

        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

                # Create Support
                $support->replymsg = $request->replymsg;
                $support->seen     = 1;

                # Redirect on Success
                if ( $support->save() ) {

                    Mail::send('emails.reply', ['support' => $support], function ($message) use ($support) {
                        $message->from(config('app.info_email'), 'کامت');
                        $message->sender(config('app.info_email'), 'کامت');
                        $message->to($support->email, $support->fullname)->subject('گروه طراحی و توسعه کامت');
                        $message->replyTo(config('app.support_email'), 'کامت');
                    });

                    return redirect()->route('admin.support.index')->with('success', 'پاسخ با موفقیت ارسال شد.');
                }
        }

        return back()->withInput()
                     ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    # Remove the specified resource from storage
    public function destroy( Support $support ) {
        $support->delete();
        return redirect()->route('admin.support.index')->with('success', 'تیکت ساپورت با موفقیت حذف شد.');
    }
}
