<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$data = $_POST['image'];
	var_dump($_FILES);
	var_dump($_POST);
	move_uploaded_file($_FILES['image']['tmp_name'], "success.png");

}
