<?php  
namespace App\Classes;

class Validation {
	
	public static function HasValue($variable){
		return ( isset($variable) && !empty($variable) );
	}
	
	private static function RegX($variable , $pattern){
		return preg_match($pattern , $variable);
	}

	public static function RegXall($variable , $pattern){
		return preg_match_all($pattern , $variable);
	}
	
	public static function PersianLettersSpace($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {     
			return self::RegX($string , "/^[اآإأبپتثجچحخدذرزژسشصضظطعغفقکگلمنوؤهةۀیئيءـًٌٍَُِِّ\sA-Za-z]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}
	
	public static function HasEmoji($string){
	    if( self::RegX($string , "/[\x{1F600}-\x{1F64F}]/u") ) {
	    	return true;
	    }
	    # Match Miscellaneous Symbols and Pictographs
	    if( self::RegX($string , "/[\x{1F300}-\x{1F5FF}]/u") ) {
	    	return true;
	    }
	    # Flag and ABC sign
	    if( self::RegX($string , "/[\x{1F170}-\x{1F251}]/u") ) {
	    	return true;
	    }
	    # Match Transport And Map Symbols
	    if( self::RegX($string , "/[\x{1F680}-\x{1F6FF}]/u") ) {
	    	return true;
	    }
	    # Match Miscellaneous Symbols
	    if( self::RegX($string , "/[\x{2600}-\x{26FF}]/u") ) {
	    	return true;
	    }
	    # Match Dingbats
	    if( self::RegX($string , "/[\x{2700}-\x{27BF}]/u") ) {
	    	return true;
	    }
	    # Some additional sign
	    if( self::RegX($string , "/[\x{1F0CF}\x{1F004}\x{3030}\x{303D}\x{3297}\x{3299}\x{2B55}\x{2B50}\x{2B1B}-\x{2B1C}\x{2B05}-\x{2B07}\x{2935}\x{2934}\x{25FB}-\x{25FE}\x{25C0}\x{25B6}\x{25AA}-\x{25AB}\x{24C2}\x{23F3}\x{23F0}\x{23E9}-\x{23EC}\x{2194}-\x{21AA}\x{2139}\x{2122}\x{20E3}\x{203C}\x{00AE}\x{00A9}]/u") ) {
	    	return true;
	    }
	    return false;
	}
}
?>