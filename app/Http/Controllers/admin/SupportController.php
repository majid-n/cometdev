<?php

namespace App\Http\Controllers\admin;

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

    # Show Create Form.
    public function create() {
        abort(404);
    }

    # Store the New resource in DB.
    public function store( Request $request ) {
        abort(404);
    }

    # Display the specified resource.
    public function show( Request $request, Support $support ) {
        abort(404);
    }

    # Show the form for reply to the specified resource.
    public function edit( Support $support ) {
        return view('supports.reply', compact('support') );
    }

    # Update the specified resource in storage.
    public function update( Request $request, Support $support ) {

        $rules = [
            'replymsg' => 'required|min:5',
        ];

        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) {

            return back()->withInput()
                         ->withErrors($validator);

        } else {

                # Create Support
                $support->replymsg      = $request->replymsg;
                $support->seen          = 1;

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
