<?php

<<<<<<< HEAD
$DB_HOST = "localhost";
$DB_USER = "s2995020";
$DB_PWD = "halierse";
$DB_NAME = "s2995020";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME) or die("Error: " . mysqli_connect_error());

mysqli_set_charset($conn, 'utf8');

if($conn){
	echo "Success";
}

=======
$link = mysqli_connect("oisincode.offyoucode.co.uk", "oisincod_task", 'r*r_QP)by)dz', "oisincod_users");
var_dump($link);
if(mysqli_connect_error()){
	echo "things";
}
else {
	echo "success";
}

?>
>>>>>>> 436c1bfa03c57660f30062315bdee54f7399ec4e
