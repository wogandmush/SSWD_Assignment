<?php

include 'init.php';

if($isMember || $isAdmin){
	session_unset();
	session_destroy();
}
header("Location: index.php");
exit();
