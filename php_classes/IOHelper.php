<?php

class IOHelper{
	public static function getDirectories($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")
			$dirname .= "/";
		$dir_handle = opendir($dirname);
		$directories = array();
		while($file = readdir($dir_handle)){
			// is_dir didn't work properly
			
			if($file[0] != '.' && mime_content_type($dirname.$file) === "directory")
				$directories[] = $file;
		}
		closedir($dir_handle);
		return $directories;
	}
	public static function getFiles($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")
			$dirname .= "/";
		$dir_handle = opendir($dirname);
		$files = array();
		while($file = readdir($dir_handle)){
			if($file[0] != '.' && mime_content_type($dirname.$file) !== "directory")
				$files[] = $file;
		}
		closedir($dir_handle);
		return $files;
	}
	public static function clearDirectory($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")		
			$dirname .= "/";
		$dir_handle = opendir($dirname);
		while($file = readdir($dir_handle)){
			if(mime_content_type($dirname.$file) !== 'directory'){
				if(!unlink($dirname.$file)){
					return FALSE;
				}
			}
		}
		closedir($dir_handle);
		return TRUE;
	}
	public static function getImages($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")
			$dirname .= "/";
		$dir_handle = opendir($dirname);
		$images = array();
		while($file = readdir($dir_handle)){
			if(explode("/", mime_content_type($dirname.$file))[0] === "image")
				$images[] = $file;
		}
		closedir($dir_handle);
		return $images;
	}
}
