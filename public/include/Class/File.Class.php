<?php 
class File {
	
	public static function DeleteFile($file){
		if( self::isExists($file) ) {
			return unlink($file);
		}
		return false;
	}

	public static function isExists($file){
		return file_exists($file);
	}
	
	public static function OrientationFixer($file){
		$image = imagecreatefromstring(file_get_contents($file));
		$exif  = exif_read_data($file);
		if( !empty($exif['Orientation']) ) {
		    switch( $exif['Orientation'] ) {
		    	case 2:
	            	imageflip($image , IMG_FLIP_HORIZONTAL);
	        		break;
	        	case 3:
		            $image = imagerotate($image , 180 , 0);
		            break;
	        	case 4:
	            	imageflip($image, IMG_FLIP_VERTICAL);
	        		break;
	        	case 5:
	            	imageflip($image, IMG_FLIP_VERTICAL);
	                $image = imagerotate($image , -90 , 0);
	       			break;
	       		case 6:
		            $image = imagerotate($image , -90 , 0);
		            break;
	       		case 7: 
	            	imageflip($image, IMG_FLIP_HORIZONTAL);    
	            	$image = imagerotate($image , -90 , 0);
	        		break;
		        case 8:
		            $image = imagerotate($image , 90 , 0);
		            break;
		    }
		}
		return $image;
	}
	
	public static function DeleteGraph($graph){
		if( is_resource($graph) ) {
			imagedestroy($graph);
		}
	}

	public static function isJPG($file){
		if( isset($file) ) {
			return ( ($file['type'] == "image/jpg" || $file['type'] == "image/jpeg" ) && ( $file['size'] > 30000 && $file['size'] < 3000000 ) && ($file['error'] === 0) );
		}
		return false;
	}
}
?>