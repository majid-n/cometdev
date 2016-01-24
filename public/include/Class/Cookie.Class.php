<?php  
class Cookie {
	
	public static function SetCookie($key , $value , $time){
		setcookie($key , $value , $time , PATH , DOMAIN_NAME , false , true);
	}

	public static function SetRawCookie($key , $value , $time){
		setrawcookie($key , $value , $time , PATH , DOMAIN_NAME , false , true);
	}
	
	public static function RemoveCookie($handler){
		setcookie($handler , NULL , time()-420000 , '/');
	}
}
?>