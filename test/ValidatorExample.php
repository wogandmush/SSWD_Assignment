<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened



$email = "quinnd6@tcd.ie";
$name = "Dan Quinn";
$date = new Input("dob", "Choose dob", "date");
$lastName = new Input("last_name", "Enter last name", "text");
$attributes = array();
$attributes["maxlength"] = 30;


$lastName->setAttributes($attributes);

$lastName->setRequired(true);
$lastName->render();

$date->render();

if(Validator::validateEmail($name))
	echo "<h4 class='text-success'>The email is valid</h4>";

else {
	echo "<h4 class='text-warning'>That email is not valid</h4>";
}








#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
