<?php

include '../header.php';
ini_set('display_errors', 1);
$name = new Input('name', 'Enter name');

function validator($data){
	if(strlen($data) > 5){
		return true;
	}
	else return false;
}
$name->setValidator('validator');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name->setData();



}

?>
<form action='Test2.php' method='POST'>
<?php
	$name->render();
?>
	<button type="submit">Submit</button>
</form>
