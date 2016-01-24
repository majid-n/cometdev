<?php  
class Validation {
	
	public static function HasValue($variable){
		return ( isset($variable) && !empty($variable) );
	}
	
	private static function RegX($variable , $pattern){
		return preg_match($pattern , $variable);
	}
	
	private static function EmailCheck($email){
		if ( filter_var($email , FILTER_VALIDATE_EMAIL) ) {
			list($userName , $mailDomain) = explode("@" , $email);
			return checkdnsrr($mailDomain , "MX") ? true : false;		
		}
		return false;
	}

	public static function Email($email){
		if( self::HasValue($email) && !self::HasEmoji($email) ) {
			return self::EmailCheck($email);
		}
		return false;
	}

	private static function Numeric($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^\d{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}

	private static function PersianLettersSpace($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {     
			return self::RegX($string , "/^[اآإأبپتثجچحخدذرزژسشصضظطعغفقکگلمنوؤهةۀیئيءـًٌٍَُِِّ\sA-Za-z]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}

	private static function Alphabetic($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^[A-Za-z]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}
	
	private static function AlphabeticSpace($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^[A-Za-z\s]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}

	private static function AlphabeticNumeric($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^[A-Za-z0-9]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}

	private static function AlphabeticNumericSpace($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^[A-Za-z0-9\s]{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}
	
	private static function Any($string , $minChar , $maxChar ){
		if( self::HasValue($string) && !self::HasEmoji($string) ) {
			return self::RegX($string , "/^.{".$minChar.",".$maxChar."}$/m");
		}
		return false;
	}
	
	public static function String($string , $type = "Alphabetic" , $minChar = 3 , $maxChar = 15){
		switch ( $type ) {
			case 'Numeric':
				return self::Numeric($string , $minChar , $maxChar);
				break;
			case 'Alphabetic':
				return self::Alphabetic($string , $minChar , $maxChar);
				break;
			case 'AlphabeticSpace':
				return self::AlphabeticSpace($string , $minChar , $maxChar);
				break;
			case 'AlphabeticNumeric':
				return self::AlphabeticNumeric($string , $minChar , $maxChar);
				break;
			case 'AlphabeticNumericSpace':
				return self::AlphabeticNumericSpace($string , $minChar , $maxChar);
				break;
			case 'PersianLettersSpace':
				return self::PersianLettersSpace($string , $minChar , $maxChar);
				break;
			case 'Any':
				return self::Any($string , $minChar , $maxChar);
				break;
			default:
				return self::Alphabetic($string , $minChar , $maxChar);
				break;
		}
	}
	
	public static function Username($username){
		if( self::HasValue($username) && !self::HasEmoji($username) ) {
			return self::RegX($username , "/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/m");
		}
		return false;
	}
	
	public static function Password($password){
		if( self::HasValue($password) && !self::HasEmoji($password) ) {
			return self::RegX($password , "/^\S*(?=\S{6,})(?=\S*[A-Za-z])(?=\S*[\d])\S*$/m");
		}
		return false;
	}
	
	public static function isMatch($password1, $password2){
		return ( $password1 == $password2 ) ? true : false;
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
	
	public static function Counter($countfield){
		if( !is_bool($countfield) && is_array($countfield) ) {
			return intval(array_shift($countfield));
		}
		return 0;
	}
}
?>