<?php

include_once 'Validator.php';

abstract class Field{
	protected $name; // the name attribute
	protected $label; // The text for the label field
	protected $attributes; // array to set things like maxlength, required, etc
	protected $data; // data retrieved from GET/POST request
	protected $errors; // array of errors to print out
	protected $validator;
	public function getName(){
		return $this->name;
	}
	public function setName(string $name){
		$this->name = $name;
	}
	public function getData($conn = null){
		if($conn)
			return mysqli_real_escape_string($conn, $this->data);
		return $this->data;
	}
	public function setData($data = null){
		if($data){
			$this->data = trim(htmlspecialchars($data));
		}
		else {
			if(!isset($_POST[$this->name])){
				$this->setError($this->name." was not set.");
			}
			else {
				$this->data = trim(htmlspecialchars($_POST[$this->name]));
			}
		}
	}
	public function getErrors(){
		return $this->errors;
	}
	public function setError($error){
		$this->errors[] = $error;
	}
	public function getAttibutes(){
		return $this->attributes;
	}
	public function setAttributes(array $attributes){ //pass in an array of attributes
		$this->attributes += $attributes;
	}
	public function setRequired(bool $which){
		if($which){
			$this->attributes[] = 'required';
		}
		else {
			$this->attributes = array_filter($this->attributes, function($val){
				return $val !== 'required';
			});
		}
	}
	public function setValidator(callable $validator){
		$this->validator = $validator;		
	}
	public function validate(){
		if(isset($this->validator) && !call_user_func($this->validator, $this->data))
			$this->setError($error);
	}
	public function render(){
		echo $this->getHTMLString();
	}
	abstract public function getHTMLString();
}
