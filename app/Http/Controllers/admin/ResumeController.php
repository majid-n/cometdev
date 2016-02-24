<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Resume;

class ResumeController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Resume $resume ) {
        $resume->delete();
        return redirect()->route('user.show',[ 'user' => $resume->user_id ])->with('success', 'اطلاعات شخصی کاربر با موفقیت حذف شد.');
    }
}
