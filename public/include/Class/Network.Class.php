<?php 
class Network {
	
	public static function FindIP(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER) === true) {
				foreach (explode(',', $_SERVER[$key]) as $ip) {
				   if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
				      return $ip;
				   }
				   return "Unknown";
				}
			}
		}
	}

	public static function UserLocation($ip){
		$Data = json_decode( file_get_contents("http://getcitydetails.geobytes.com/GetCityDetails?fqcn=".$ip) );
		if( Validation::HasValue($Data->geobytesregion) && Validation::HasValue($Data->geobytescountry) ) {
			return $Data->geobytesregion.", ".$Data->geobytescountry;
		}
		return "Unknown";
		
	}
	
	public static function GetUserAgent(){ 
	    $userAgent 	 = $_SERVER['HTTP_USER_AGENT']; 
	    $browserName = 'Unknown';
	    $platform 	 = 'Unknown';

	    if ( preg_match('/linux/i' , $userAgent) ) {
	        $platform = 'Linux';
	    }
	    elseif ( preg_match('/macintosh|mac os x/i' , $userAgent) ) {
	        $platform = 'Mac';
	    }
	    elseif ( preg_match('/windows|win32/i' , $userAgent) ) {
	        $platform = 'Windows';
	    }
	    
	    if( preg_match('/MSIE/i' , $userAgent) && !preg_match('/Opera/i' , $userAgent) ) { 
	        $browserName = 'Internet Explorer'; 
	        $userBrowser = "MSIE";
	    }
	    elseif( preg_match('/Trident/i' , $userAgent) && !preg_match('/Opera/i' , $userAgent) ) {
	    	$browserName = 'Internet Explorer'; 
	        $userBrowser = "rv";
	    }
	    elseif( preg_match('/Firefox/i' , $userAgent) ) { 
	        $browserName = 'Mozilla Firefox'; 
	        $userBrowser = "Firefox"; 
	    } 
	    elseif( preg_match('/Chrome/i' , $userAgent) ) { 
	        $browserName = 'Google Chrome'; 
	        $userBrowser = "Chrome"; 
	    } 
	    elseif( preg_match('/Safari/i' , $userAgent) ) { 
	        $browserName = 'Apple Safari'; 
	        $userBrowser = "Safari";
	    } 
	    elseif( preg_match('/Opera/i' , $userAgent) ) { 
	        $browserName = 'Opera'; 
	        $userBrowser = "Opera"; 
	    }
	    elseif( preg_match('/Netscape/i' , $userAgent) ) { 
	        $browserName = 'Netscape';
	        $userBrowser = "Netscape"; 
	    } 
	    
	    return array( 'name' => $browserName , 'platform' => $platform );
	}
}
?>