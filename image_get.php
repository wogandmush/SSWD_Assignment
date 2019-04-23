<?php

include 'init.php';
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	if(isset($_GET['category'])){
		$category = $_GET['category'];

		$fsRoot = PathHelper::getFSRoot();
		$root = PathHelper::getRoot();


		$images = IOHelper::getImages("$fsRoot/images/$category");
		$images = array_map(function($image){
			global $category, $root;
			$imagePath =  "$root/images/$category/$image";
			return $imagePath;
		}, $images);
		echo json_encode($images);
	}
}

