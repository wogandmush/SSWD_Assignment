<?php

class ContentHelper{
	public static function toJSON($array){
		echo json_encode(array_map(function($content){
	return $content->toArray();		
}, $array));
	}	
}
