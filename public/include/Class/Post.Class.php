<?php  
class Post extends Instantiate{

	public $id;
	public $title;
	public $des;
	public $sdes;
	public $link;
	public $type;
	public $thumb;
	public $img;
	public $time;
	public $view;
	public $active;


	public static $tableName = "posts";

	public static function FindAll($Fields = "*"){
		return parent::All($Fields , "WHERE active = 1");
	}

	public static function FindById($id = 0 , $Fields = "*"){
		return parent::Id($id , $Fields , "WHERE id = {$id} AND active = 1 LIMIT 1");
	}

	public static function Pagination($limit,$page){
		$offset  = intval( $limit * ($page - 1) );
		return parent::All("*" , "WHERE active = 1 LIMIT {$limit} OFFSET {$offset}");
	}

	public function Like(){
		$time = Time::Now();
		$ip   = Network::FindIp();
		return MySqlDataBase::Insert(Like::$tableName , "post_id,ip,likedat",intval($this->id).",'{$ip}','{$time}'");
	}

	public function TotalLikes(){
		return parent::TotalRow("JOIN ".self::$tableName." ON ".self::$tableName.".id = ".Like::$tableName.".post_id WHERE post_id = ".intval($this->id), Like::$tableName);
	}

	public function isliked(){
		$ip = Network::FindIP();
		return parent::TotalRow("WHERE post_id = ".intval($this->id)." AND ip = '{$ip}'" , Like::$tableName);
	}
}
?>