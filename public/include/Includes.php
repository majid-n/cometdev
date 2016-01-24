<?php

# Core Files
require_once(__DIR__.DIRECTORY_SEPARATOR."Configuration.php");
require_once(__DIR__.DIRECTORY_SEPARATOR."Asset".DIRECTORY_SEPARATOR."PHPmailer".DIRECTORY_SEPARATOR."PHPMailerAutoload.php");

# Class Files
spl_autoload_register(
	function ($class) {
	    $path = __DIR__.DIRECTORY_SEPARATOR."Class".DIRECTORY_SEPARATOR."{$class}.Class.php";
	    if( file_exists($path) ){
			require_once($path);
		}else {
			die("The file {$class} not Found !!!");
		}
	}
);

?>
