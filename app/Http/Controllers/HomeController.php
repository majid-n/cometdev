<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Like;
use App\Post;

class HomeController extends Controller
{
    # Create Index Page
	public function index() {
 
		$totallikes    = Like::count();
		$totalposts    = Post::count();
		$posts         = Post::with('cat','likes')->paginate(config('app.posts_per_page'));
		$page          = $posts->currentPage();
		$lastpage      = $posts->lastPage();

		return view('index',compact('totallikes','totalposts','posts','page','lastpage','title'));
	}
}