<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Edu;

class EduController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Edu $edu ) {
        $edu->delete();
        return redirect()->route('user.show',[ 'user' => $edu->user_id ])->with('success', 'تحصیلات با موفقیت حذف شد.');
    }
}
