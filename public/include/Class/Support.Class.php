<?php  
class Support extends Instantiate{

	public $id;
	public $email;
	public $fullname;
	public $tel;
	public $des;
	public $submitat;
	public $ip;
	public $location;
	public $session_id;
	public $seen;
	public $replymsg;
	public $replyat;

	public static $tableName = "support";
}
?>