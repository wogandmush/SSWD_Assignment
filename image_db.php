<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	spl_autoload_register(function($class_name){
		include __DIR__.'/components/'.$class_name .'.php';
	});
	$response = array();
	$data = $_POST['image'];
	$category = $_POST['img-category'];
	$tempFile = $_POST['temp-file'];
	$name = $_POST['file-name'];
	$name .= ".jpg";
	$path = "./images/$category/$name";
	//echo $path;
	if(move_uploaded_file($_FILES['image']['tmp_name'], $path)){
		
		$response['status'] = 'success';
		$response['path'] = $path;
		$response['temp-file'] = $tempFile;
		echo json_encode($response);
		
		$fsRoot = PathHelper::getFSRoot();
		IOHelper::clearDirectory("$fsRoot/images/.temp");
		exit();
	}
}
