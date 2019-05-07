<?php
class StringHelper{
	public static function toSkeletonCase($string){
		return preg_replace('/\s/', '-', strtolower($string));
	}
}
