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
	public static function validatePhoneNumber($data){
		//needs work
		return preg_match('/^\+?[\d\s\-()]{7,}$/',$data);
	}
	public static function validatePassword(){
	// password must be at least 8 characters
	if(strlen($password) < 8)
		return false;
	// password must have one alphanumeric character
	if(!preg_match("/[\W]/", $password))
		return false;
	// password must have one number
	if(!preg_match("/[\d]/", $password))
		return false;
	// password must have at least two alphabetical characters
	if(preg_match_all("/[A-Za-z]/", $password) < 2)
		return false;
	return true;
		
	}
}
