<?php 
class Ajax {
	
	public static function isAjax($RequestType = "POST"){
	  return ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $_SERVER['REQUEST_METHOD'] == $RequestType );
	}
	
	public static function JSON($fieldArray , $valueArray){
		foreach ( $fieldArray as $key => $value ) {
			$resultArray[$value] = $valueArray[$key];
		}
		return json_encode($resultArray);
	}
}
?>