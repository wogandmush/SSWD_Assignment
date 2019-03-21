<?php

session_start();

if(isset($_SESSION['user_no'])){
	session_unset();
	session_destroy();
}
header("Location: index.php");
exit();
