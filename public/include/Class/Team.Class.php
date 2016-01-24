<?php  
class Team extends Instantiate{

	public $id;
	public $fullname;
	public $image;
	public $password;
	public $type;
	public $email;
	public $github;
	public $facebook;
	public $twitter;
	public $instagram;
	public $php;
	public $mysql;
	public $javascript;
	public $jquery;
	public $angular;
	public $node;
	public $html;
	public $css;
	public $ps;
	public $ai;
	public $role;

	public static $tableName = "team";

	public static function Admins($Fields = "*"){
		return parent::All($Fields,"WHERE role = 'admin' AND password IS NOT NULL");
	}

	public static function Members($Fields = "*"){
		return parent::All($Fields,"WHERE role = 'member' AND password IS NULL");
	}
}
?>