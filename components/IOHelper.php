<?php
class IOHelper{

	public static function getDirectories($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")
			$dirname .= "/";
		echo $dirname;
		$dir_handle = opendir($dirname);
		$directories = array();
		while($file = readdir($dir_handle)){
			// is_dir didn't work properly
			
			if(mime_content_type($dirname.$file) === "directory")
				$directories[] = $file;
		}
		closedir($dir_handle);

		return array_slice($directories, 2);
	}
	public static function getFiles($dirname){
		if($dirname[strlen($dirname) - 1] !== "/")
			$dirname .= "/";
		$dir_handle = opendir($dirname);
		$files = array();
		while($file = readdir($dir_handle)){
			if(mime_content_type($dirname.$file) !== "directory")
				$files[] = $file;
		}
		closedir($dir_handle);
		return $files;
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
