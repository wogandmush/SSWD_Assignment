<?php

#
# The toJSON method takes in an array of dynamic-content type components, and converts them to json
#
# This allows them to be handled easily via Javascript
#

class ContentHelper{
	public static function toJSON($array){
		echo json_encode(array_map(function($content){
	return $content->toArray();		
}, $array));
	}	
}
