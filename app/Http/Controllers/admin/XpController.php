<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Xp;

class XpController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Xp $xp ) {
        $xp->delete();
        return redirect()->route('user.show',[ 'user' => $xp->user_id ])->with('success', 'سابقه با موفقیت حذف شد.');
    }
}
