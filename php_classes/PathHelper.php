<?php

class PathHelper {
	// trim a directory level off of a path
	public static function getParentDirectory($dir, $levels = 1){
		$exploded = explode("/", $dir);
		$arr = array_slice($exploded, 0, count($exploded) - $levels);
		return implode("/", $arr);
	}
	// get the fsroot, useful for IO operations
	public static function getFSRoot(){
		$cwdArray = explode("/", getcwd());
		$root_array = array_slice($cwdArray, 0, 1+array_search("SSWD_Assignment", $cwdArray));
		$root = implode("/", $root_array);
		return $root;
	}
	// get the /SSWD_Assignment/ defacto root url
	public static function getRoot(){
		$uri = $_SERVER['REQUEST_URI'];
		$uri_array = explode("/", $uri);
		$root_array = array_slice($uri_array, 0, 1+ array_search("SSWD_Assignment", $uri_array));
		$root = implode("/", $root_array);
		return $root;
	}
}
