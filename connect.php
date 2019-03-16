<?php

$DB_HOST = "localhost";
$DB_USER = "s2995020";
$DB_PWD = "halierse";
$DB_NAME = "s2995020";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME) or die("Error: " . mysqli_connect_error());

mysqli_set_charset($conn, 'utf8');

if($conn){
	echo "Success";
}

