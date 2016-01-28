<?php 

namespace App\Classes;

Class Background{

	# Retrive random Images from /backgrounds folder
	public static function Random($Pieces = 1) {

		$FilesArray = array_where(scandir(public_path('img/backgrounds')), function ($key, $value) {
                return !preg_match('/^\.{1,}/', $value);
            });

		if( $Pieces > 1 ) {

			$randomArray = array();

			for ( $i = 0 ; $i < $Pieces ; $i++ ) $randomArray[] = $FilesArray[array_rand($FilesArray)];
			return $randomArray;
		}

		return $FilesArray[array_rand($FilesArray)];
    }
}