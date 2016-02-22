<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Skill;

class SkillController extends Controller
{
    # Dependency Injection & Controllers & Middlewares
	public function __construct(){
	    # Define Middleware
	}

    # Remove the specified resource from storage
    public function destroy( Skill $skill ) {
        $skill->delete();
        return redirect()->route('user.show',[ 'user' => $skill->user_id ])->with('success', 'مهارت با موفقیت حذف شد.');
    }
}
