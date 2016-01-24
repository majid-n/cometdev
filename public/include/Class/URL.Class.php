<?php 
class URL {
	
	public static function Self(){
		return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
	
	public static function Referer(){
		if( isset($_SERVER['HTTP_REFERER']) ) {
			return $_SERVER['HTTP_REFERER'];
		}
		return "Direct Reference";		
	}
	
	public static function To($URL , $Param = ""){
		session_write_close();
		header('Location: '.$URL.$Param);
		exit;
	}
}
?>