<?php

require_once '../config/connect.php';
class DBConnect{
	public static function getConnection(){
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('Error: '. mysqli_connect_error());
		mysqli_set_charset($conn, 'utf8');
		return $conn;
	}
}
