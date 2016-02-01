<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Post;
use App\Cat;
use Image;

class AdminController extends Controller
{
    public function Posts( Request $request ) {

    	$posts = Post::where('active', 1)->get();
    	$TotalNewPosts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
    	$default = [''=>'دســـته را انتخاب کنید'];
    	$cats = Cat::lists('title', 'id');
    	$listArray = $default + $cats->toArray();

    	return view()->make('admin.posts', compact('posts','TotalNewPosts','listArray'));
    }

    public function AddPost( Request $request ) {

	    	$rules = array(
	            'title'				=> 'required|min:5|max:80',
	            'description'		=> 'required|min:5',
	            'smalldescription'	=> 'required|min:5',
	            'link'				=> 'required|active_url',
	            'cat_id'			=> 'required|numeric',
	            'image'				=> 'required'
	        );

	        $validator = Validator::make( $request->all(), $rules);

	        if ($validator->fails()) {
	            $errors = $validator->messages();

	            return redirect()->back()
	    						 ->withInput()
	    						 ->withErrors($errors);

	        } else {

	        	$Image 	 	= $request->file('image'); //Image Object
	        	$Filename	= $Image->getClientOriginalName(); //Image File Name
	        	$Thumbname  = explode('.', $Filename)[0] . '_thumb.' . $Image->getClientOriginalExtension(); //Thumb File Name
	        	$savedImg 	= $Image->move( storage_path('app/portfolio') , $Filename ); //Saved Image Address

	        	Image::make($savedImg)
					        	->resize(300, null, function ($constraint) {
					        	    $constraint->aspectRatio();
					        	})
					        	->save(storage_path('app/portfolioThumb/'). $Thumbname); //Saved Thumb

	    		$Post = new Post;
	    		$Post->title 	 		= $request->title;
	    		$Post->description 	 	= $request->description;
	    		$Post->smalldescription = $request->smalldescription;
	    		$Post->link 	 		= $request->link;
	    		$Post->cat_id 			= $request->cat_id;
	    		$Post->image  			= $Filename;
	    		$Post->thumb  			= $Thumbname;

	    		if ( $Post->save() ) {
	    			return Redirect()->to('/Posts')
	    							 ->withSuccess('محصول با موفقیت ثبت شد.');
	    		}
	    	}

	    return response()->json([ 'result' => 'fail' ]);

    }

    public function DeletePost( Request $request , Post $Post) {
    	//
    }
}
