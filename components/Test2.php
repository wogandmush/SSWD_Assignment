<?php

include '../header.php';
include 'Validator.php';

ini_set('display_errors', 1);
$name = new Input('name', 'Enter name');

function validator($data){
	if(strlen($data) > 5){
		return true;
	}
	else return false;
}
$name->setValidator('validator');

$email = new Input('email', 'Enter email', 'email');
$email->setValidator('Validator::validateEmail');
$date = new Input('date', 'Pick date', 'date');
$date->setValidator('Validator::validateDate');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name->setData();
	$email->setData();
	$date->setData();

}

?>
<form action='Test2.php' method='POST'>
<?php
	$name->render();
	$email->render();
	$date->render();
?>
	<button type="submit">Submit</button>
</form>
