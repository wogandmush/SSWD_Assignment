<?php

$above = PathHelper::getParentDirectory(PathHelper::getFSRoot());
require_once "$above/config/connect.php";

#
# the getConnection() method is used to get a database connection.
# it is more reliable than include '../config/connect.php', as it can 
# be called the same way from any directory, and there is no risk of 
# including it multiple times, and causing errors when the 
# same constants are declared more than once
# 

class DBConnect{
	public static function getConnection(){
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('Error: '. mysqli_connect_error());
		mysqli_set_charset($conn, 'utf8');
		return $conn;
	}
}
