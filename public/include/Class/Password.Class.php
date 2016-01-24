<?php  
class Password {

	public static function SuitableCost($cost = 8 , $timeTarget = 0.05){
		do {
		    $cost++;
		    $start = microtime(true);
		    password_hash("test" , PASSWORD_BCRYPT , array( "cost" => $cost ));
		    $end = microtime(true);
		} while( ($end - $start) < $timeTarget );
		return $cost;
	}
	
	public static function GenerateSalt($length){
		$salt 		  = mcrypt_create_iv(22 , MCRYPT_DEV_URANDOM);
		$base64String = Encryption::Base64En($salt);
		return substr($base64String , 0 , $length);
	}
	
	public static function EncryptString($userPassword){
		return password_hash($userPassword , PASSWORD_BCRYPT , array( "cost" => 10 ));
	}
	
	public static function Match($userPassword , $databaseHash){
		return password_verify($userPassword , $databaseHash);
	}
}
?>