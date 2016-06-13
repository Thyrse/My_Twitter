<?php
class Model{
	private static $host = 'mysql:host=localhost;';
	private static $_user = 'root';
	private static $_password = '';
	private static $_db = 'common-database';
	public static $pdo;

	public function __construct()
	{
		if( is_null(self::$pdo)) self::$pdo = new PDO(self::$host . "dbname=" . self::$_db .";charset=utf8", self::$_user, self::$_password);
	}

	public static function qry($sql, $options=[])
	{
		$a = self::$pdo->prepare($sql);
		$a->execute($options);
		$a = $a->fetchAll(PDO::FETCH_OBJ);
		return $a;
	}

	public function update($sql, $options=[])
	{
		$a = self::$pdo->prepare($sql);
		$a->execute($options);
	}

	public static function getFromId($id, $type)
	{
		return self::qry("SELECT $type FROM member WHERE id = :id", ['id' => $id])[0]->$type;
	}	
}
?>