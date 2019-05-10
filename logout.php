<?php

#
# This allows logged in users/admins to logout, ending their session
#
#

include 'init.php';

if($isMember || $isAdmin){
	session_unset();
	session_destroy();
}
header("Location: index.php");
exit();
