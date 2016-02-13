<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lang;

class LangController extends Controller
{
	# Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Lang $lang ) {
        $lang->delete();
        return redirect()->route('user.show',[ 'user' => $lang->user_id ])->with('success', 'زبان با موفقیت حذف شد.');
    }
}
