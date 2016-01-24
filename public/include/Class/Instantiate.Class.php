<?php  
class Instantiate {

	public static $tableName;

	public static function All($Fields = "*" , $Clauses = ""){
		$AllDataArray = MySqlDataBase::Select($Fields , static::$tableName , $Clauses);

		if( is_array($AllDataArray) && !is_bool($AllDataArray) ) {

			$ObjectArray = array();
			foreach ( $AllDataArray as $SingleDataArray ) {
				$ObjectArray[] = self::MakeObjectArray($SingleDataArray);
			}
			return $ObjectArray;
		}

		return false;
	}

	public static function Id($id = 0 , $Fields = "*" , $Clauses = ""){
		if( !Validation::HasValue($Clauses) ) {
			$Clauses = "WHERE id = {$id} LIMIT 1";
		}

		$DataArray = Core::ArrayShift(MySqlDataBase::Select($Fields , static::$tableName , $Clauses));

		if( is_array($DataArray) && !is_bool($DataArray) ) {
			return self::MakeObjectArray($DataArray);
		}

		return false;
	}

	public static function TotalRow($Clauses = "" , $Table = "") {
		if( !Validation::HasValue($Table) ) {
			$Table = static::$tableName;
		}
		
		$Total = Core::ArrayShift(MySqlDataBase::Select("COUNT(*)" , $Table , $Clauses));
		return Validation::Counter($Total);
	}

	public static function MakeObjectArray($DataArray){
		$Class  = get_called_class();
		$Object = new $Class;

		foreach ( $DataArray as $attribute => $Value) {

			if( $Object->HasAttribute($attribute) ) {
				$Object->$attribute = $Value;
			}
		}

		return $Object;
	}

	private function HasAttribute($attribute){
		# Return all Property of this class in an array (incl. Private Property)
		$ObjectVariables = get_object_vars($this);
		# Check $attribute exist in Property of this class Return T/F
		return array_key_exists($attribute , $ObjectVariables);
	}
}
?>