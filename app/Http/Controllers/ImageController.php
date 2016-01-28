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
    public function RetriveImages($Disk , $Filename) {	

		$File 	= Storage::disk($Disk)->get( $Filename );
		$Image  = Image::make($File);
	    $Type 	= $Image->mime();

	    return $Image->response($Type);
	}

	# Retrive Images Advanced Mode
	public function RetriveImagesAdvanced($Disk, $Width, $Height, $Watemark, $Filename){

		$FinalWidth   = ( $Width > 0 )  			? intval($Width)  	: NULL;
		$FinalHeight  = ( $Height > 0 ) 			? intval($Height) 	: NULL;
		$HasWatermark = ( $Watemark == 0 ) 			? false 			: true;
		$Logo    	  = public_path('img/logo/').'watermark-comet.png';


		$File 	= Storage::disk($Disk)->get( $Filename );
		$Image  = Image::make($File);
		$Type 	= $Image->mime();

		if( isset($FinalWidth) || isset($FinalHeight) ) {

			$Image->resize($FinalWidth, $FinalHeight, function ($constraint) {
			    $constraint->aspectRatio();   # For Auto height or Auto width
			    $constraint->upsize();		  # Prevent to retrieve higher resoloution than it self
			});

		}

		if( $HasWatermark ) $Image->insert($Logo, 'bottom-right', 15, 15);

		return $Image->response($Type);
	}
}