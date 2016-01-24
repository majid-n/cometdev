<?php  
class Visitor extends Instantiate{

	public $id;
	public $ip;
	public $browser;
	public $platform;
	public $referer;
	public $page;
	public $time;
	public $location;

	public static $tableName = "visitor_counter";

	public static function Add(){

		$isVisited = Session::GetSession('isVisited');
		
		if( Validation::HasValue($isVisited) && is_bool($isVisited) && $isVisited === true ) {
			return false;
		}

		$time 		= Time::Now();
		$ip 		= Network::FindIP();
		$location   = Network::UserLocation($ip);
		$userAgent  = Network::GetUserAgent();
		$page 		= URL::Self();
		$referer 	= URL::Referer();
		$port 		= $_SERVER['SERVER_PORT'];

		if( MySqlDataBase::Insert(self::$tableName , "ip,location,browser,platform,referer,page,time" , "'{$ip}','{$location}','{$userAgent['name']}','{$userAgent['platform']}','{$referer}','{$page}','{$time}'") ) {
			Session::SetSession('isVisited',true);
			return true;
		}

		return false;
	}
}
?>