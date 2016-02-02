<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Image;

class ImageController extends Controller
{

	# Retrive Images
    public function retriveImages($disk , $filename) {	

		$file 	= Storage::disk($disk)->get( $filename );
		$image  = Image::make($file);
	    $type 	= $image->mime();

	    return $image->response($type);
	}

	# Retrive Images Advanced Mode
	public function retriveImagesAdvanced($disk, $width, $height, $watemark, $filename){

		$finalwidth   = ( $width > 0 )  			? intval($width)  	: NULL;
		$finalheight  = ( $height > 0 ) 			? intval($height) 	: NULL;
		$haswatermark = ( $watemark == 0 ) 			? false 			: true;
		$logo    	  = public_path('img/logo/').'watermark-comet.png';


		$file 	= Storage::disk($disk)->get( $filename );
		$image  = Image::make($file);
		$type 	= $image->mime();

		if( isset($finalwidth) || isset($finalheight) ) {

			$image->resize($finalwidth, $finalheight, function ($constraint) {
			    $constraint->aspectRatio();   # For Auto height or Auto width
			    $constraint->upsize();		  # Prevent to retrieve higher resoloution than it self
			});

		}

		if( $haswatermark ) $image->insert($logo, 'bottom-right', 15, 15);

		return $image->response($type);
	}
}