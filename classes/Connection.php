<?php
class Connection{
	const DBNAME = 'recruitment';
	const HOST = 'localhost';
	const USERNAME = 'root';
	const PASSWORD = '';
	
	public static function get_DefaultConnection(){
		$tmpConn = new MySQLi(Connection::HOST,Connection::USERNAME,Connection::PASSWORD,Connection::DBNAME);
		$tmpConn->autocommit(false);
		if ($tmpConn->connect_error){
			throw new Exception("Error on connecting to database");
		}
		return $tmpConn;
	}
}
?>