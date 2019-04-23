<?php

include 'init.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['new-category'])){
		$fsRoot = PathHelper::getFSRoot();
		$new_category = $_POST['new-category'];
		$new_dir = "$fsRoot/images/$new_category";
		if(mkdir($new_dir)){
			echo json_encode(["success"=>true, "new_category"=>$new_category]);						
			exit();
		}
		echo json_encode(['success'=>false]);
		exit();
	}
	else if(isset($_POST['image'])){
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
}
