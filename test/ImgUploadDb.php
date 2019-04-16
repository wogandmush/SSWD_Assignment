<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$data = $_POST['image'];
	var_dump($_FILES);
	move_uploaded_file($_FILES['image']['tmp_name'], "success.png");
	/*
	$handler = fopen("./image.png", "w");
	fwrite($handler, $data);
	fclose($handler);
	file_put_contents("./imagae.png", $data);
*/
	

}
