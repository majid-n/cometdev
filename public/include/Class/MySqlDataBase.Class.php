<?php
class MySqlDataBase extends mysqli{

	private static $DatabaseConnection;
	
	public static function ConnectDB(){
		$connection = new parent(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if ( $connection->connect_errno ) {
	    	die( "Connect failed: ".$connection->connect_error );
		}
		self::$DatabaseConnection = $connection;
		self::UTF();
	}
	
	public static function CloseDB(){
		if( isset(self::$DatabaseConnection) ) {
			self::$DatabaseConnection->close();
		}
	}
	
	public static function GetConnectionHandler(){
		return self::$DatabaseConnection;
	}

	public static function SpecialQuery($query){
		$result = self::$DatabaseConnection->query($query);
		return ($result) ? self::fetchQuery($result) : false;
	}
	
	public static function Select($fieldName , $tableName , $condition = ""){
		$Sql  	= "SELECT ".$fieldName." FROM ".$tableName." ";
		$Sql   .= $condition;
		$result = self::$DatabaseConnection->query($Sql);
		return ($result) ? self::fetchQuery($result) : false;
	}
	
	public static function Insert($tableName , $fieldName , $value , $condition = ""){
		$Sql  	= "INSERT INTO ".$tableName." ( ".$fieldName." ) ";
		$Sql   .= "VALUES ( ".$value." ) ";
		$Sql   .= $condition;
		$result = self::$DatabaseConnection->query($Sql);
		return ( $result && self::AffectedRow() >= 1 ) ? true : false;
	}
	
	public static function Update($tableName , $fieldNameNvalue , $condition = ""){
		$Sql 	= "UPDATE ".$tableName." SET ".$fieldNameNvalue." ";
		$Sql   .= $condition;
		$result = self::$DatabaseConnection->query($Sql);
		return ( $result && self::AffectedRow() >= 1 ) ? true : false;	
	}
	
	public static function Delete($tableName , $condition = ""){
		$Sql  	=  "DELETE FROM ".$tableName." ";
		$Sql   .=  $condition;
		$result = self::$DatabaseConnection->query($Sql);
		return ( $result && self::AffectedRow() >= 1 ) ? true : false;
	}	
	
	private static function fetchQuery($result){
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$rows[] = $row;
			}
			self::freeSQL($result);
			return $rows;
		}
		return false;
	}

	public static function UTF(){
		# ut8mb4 Useful for Emojies
		$Sql = "SET character_set_results=utf8 , character_set_client=utf8 , character_set_connection=utf8 , character_set_database=utf8 , character_set_server=utf8";
		return self::$DatabaseConnection->query($Sql);
	}

	public static function EscapeSQL($Variable){
		return self::$DatabaseConnection->real_escape_string(trim($Variable));
	}

	private static function freeSQL($result){
		$result->free();
	}

	public static function LastInsertId(){
		return intval(self::$DatabaseConnection->insert_id);
	}

	private static function AffectedRow(){
		return intval(self::$DatabaseConnection->affected_rows);
	}
}

MySqlDataBase::ConnectDB();
?>