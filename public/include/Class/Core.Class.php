<?php 
class Core {
	
	private static function SizeMaker($size){
	    $unit = array('B' , 'Kb' , 'Mb' , 'Gb' , 'Tb' , 'Pb');
	    return round( $size/pow(1024 , ($i = floor(log($size , 1024)))) , 2 ).' '.$unit[$i];
	}
	
	public static function UsedMemory(){
		return self::SizeMaker(memory_get_peak_usage());
	}
	
	public static function SubString($string , $lenth = 255 , $char = '.', $endoftxt = '.'){
		if( strlen($string) > $lenth ) {

			$pos = strpos($string , $char , $lenth);
			return ( is_numeric($pos) ) ? substr($string , 0 , $pos).$endoftxt : substr($string , 0 , $lenth).'...';
		}

		return $string;
	}
	
	public static function UnsetVar($variable){
		if( isset($variable) ) {
			unset($variable);
		}
	}

	public static function ArrayShift($array){
		return ( is_array($array) && !is_bool($array) ) ? array_shift($array) : false;
	}
	
	public static function RandomNumber($length = 5){
		return substr(number_format(time() * mt_rand() , 0 , '' , '') , 0 , $length);
	}

	public static function ShortenNumber($number){

		if( !is_numeric($number) ) 			return false;
        if( $number >= 1000000000000 ) 		return round( ($number/1000000000000),0 ).'T';
        else if( $number >= 1000000000 ) 	return round( ($number/1000000000),0 ).'B';
        else if( $number >= 1000000 ) 		return round( ($number/1000000),0 ).'M';
        else if( $number >= 1000 ) 			return round( ($number/1000),0 ).'K';
        
        return number_format($number);
	}
}
?>