<?php

class PathHelper {

	public static function getFSRoot(){
		$cwdArray = explode("/", getcwd());
		$root_array = array_slice($cwdArray, 0, 1+array_search("SSWD_Assignment", $cwdArray));
		$root = implode("/", $root_array);
		return $root;
	}

	public static function getRoot(){
		$uri = $_SERVER['REQUEST_URI'];
		$uri_array = explode("/", $uri);
		$root_array = array_slice($uri_array, 0, 1+ array_search("SSWD_Assignment", $uri_array));
		$root = implode("/", $root_array);
		return $root;
	}
}
