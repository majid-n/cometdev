<?php 
class Background{

	public static function Random(){
		$FolderFiles = self::All();
		return $FolderFiles[array_rand($FolderFiles)];
	}

	public static function All(){
		$FolderFiles = array_slice(scandir(dirname(dirname(__DIR__)).DS."public_html".DS."img".DS."backgrounds"), 3);
		return $FolderFiles;
	}
}


?>