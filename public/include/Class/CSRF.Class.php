<?php 
Class CSRF{

	private static $Token;

	public static function Generate(){

		if( isset($_SESSION['CSRF']) ) {
			Session::DeleteSession('CSRF');
		}

		self::$Token = Password::GenerateSalt(20);
		Session::SetSession('CSRF',self::$Token);
	}

	public static function Validation($Token){
		return ( Encryption::Decrypt($Token) == Session::GetSession('CSRF') && Validation::HasValue($Token) ) ? true : false;
	}

	public static function GetToken(){
		return Encryption::Encrypt(self::$Token);
	}
}
?>