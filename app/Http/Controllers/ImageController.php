<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Image;

class ImageController extends Controller
{


	# Retrive BackGround Images
    public function Backgrounds($width, $height, $filename) {	

		$file = Storage::disk('local')->get('backgrounds/'. $filename);

		if( $width === 'auto' && $height === 'auto' ) $img  = Image::make($file);
		else $img  = Image::make($file)->resize($width, $height);
	    
	    $type = $img->mime();

	    // insert watermark at bottom-right corner with 10px offset
		$img->insert(public_path().'\\img\\logo\\comet_fa.png', 'bottom-right', 30, 30);

	    return $img->response($type);
	}
}
