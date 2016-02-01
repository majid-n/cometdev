<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Classes\BackGround;
use App\Like;
use App\Post;

class HomeController extends Controller
{
    # Create Index Page
    public function index() {

        $title         = 'گروه طراحی و توسعه کامت';
        $Background    = Background::Random(2);
    	$TotalLikes    = Like::count();
    	$TotalPosts    = Post::count();
    	$TotalNewPosts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
    	$Posts         = Post::with('cat','likes')->paginate(config('app.posts_per_page'));
        $Page          = $Posts->currentPage();
        $LastPage      = $Posts->lastPage();

    	return view('index',compact('TotalLikes','TotalPosts','TotalNewPosts','Posts','Page','LastPage','title','Background'));
    }
}

    // $Admins         = Team::Admins("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");
    // $Members        = Team::Members("id,fullname,image,type,email,github,facebook,twitter,instagram,php,mysql,javascript,jquery,angular,node,html,css,ps,ai");