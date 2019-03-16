<?php

$link = mysqli_connect("oisincode.offyoucode.co.uk", "oisincod_task", 'r*r_QP)by)dz', "oisincod_users");
var_dump($link);
if(mysqli_connect_error()){
	echo "things";
}
else {
	echo "success";
}

?>
