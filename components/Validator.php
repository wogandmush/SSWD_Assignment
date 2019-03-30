<?php

class Validator{
	public static function validateEmail($data){
		if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		return true;
	}

	public static function validateDate($data){
		$exploded = explode("-", $data);
		if(!checkdate($exploded[1], $exploded[2], $exploded[0]))
			return false;
		return true;
	}
}
