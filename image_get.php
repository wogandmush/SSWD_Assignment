<?php


spl_autoload_register(function($class_name){
	include __DIR__.'/components/'.$class_name .'.php';
});

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
