<?php
class Session {

	private static $isLoggin = false;
	public  static $UID;

	public static function StartSession(){
		session_start();
		self::CheckLogin();
	}

	public static function SetEncryptSession($sessionName , $sessionVal){
		$_SESSION[$sessionName] = Encryption::Encrypt($sessionVal);
	}

	public static function GetEncryptSession($sessionName){
		if( !isset($_SESSION[$sessionName]) ) {
			return false;
		}
		return Encryption::Decrypt($_SESSION[$sessionName]);
	}

	public static function SetSession($sessionName , $sessionVal){
		$_SESSION[$sessionName] = $sessionVal;
	}

	public static function GetSession($sessionName){
		if( !isset($_SESSION[$sessionName]) ) {
			return false;
		}
		return $_SESSION[$sessionName];
	}

	public static function DeleteSession($sessionName){
		unset($_SESSION[$sessionName]);
	}

	private static function CheckLogin(){
		if( isset($_SESSION['UID']) ) {

			self::$UID = intval(self::GetEncryptSession('UID'));

			if( is_numeric(self::$UID) && self::$UID > 0 ) {
				self::$isLoggin = true;
			}else {
				self::Logout();
			}
		}else{
			Core::UnsetVar(self::$UID);
			self::$isLoggin = false;
		}
	}

	public static function isLogin(){
		return self::$isLoggin;
	}

	public static function Login($User) {
		if( is_object($User) ) {			
			self::SetEncryptSession('UID', intval($User->id));
			self::SetEncryptSession('isverify', intval($User->isverify));
			self::SetSession('fullname', $User->FullName());
			self::SetSession('profilepicture', $User->profilepicture);
			self::$UID 		= intval($User->id);
			self::$isLoggin = true ;
			if( Validation::HasValue($User->role) ) {
				self::SetEncryptSession('role',$User->role);
			}
		}
	}

	public static function Logout(){
		if( isset($_COOKIE[session_name()]) ) {

			if( isset($_COOKIE['token']) ) {

				if( MySqlDataBase::Update("users" , "token = NULL" , "WHERE id = ".self::$UID." AND isdeleted = 0 LIMIT 1") ) {

					Cookie::RemoveCookie("token");
					self::DestroySession();
					return true;
				}
			}else{
				self::DestroySession();
				return true;
			}
		}
		return false;
	}

	private static function DestroySession(){
		setcookie(session_name() , '' , time()-42000 , '/');
		session_destroy();
		self::CheckLogin();
	}
}

Session::StartSession();
?>