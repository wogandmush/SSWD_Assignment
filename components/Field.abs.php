<?php
abstract class Field{
	protected $name; // the name attribute
	protected $label; // The text for the label field
	protected $attributes; // array to set things like maxlength, required, etc
	protected $data; // data retrieved from GET/POST request
	protected $errors; // array of errors to print out
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
	public function setData($data){
		$this->data = trim(htmlspecialchars($data));
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
	public function render(){
		echo $this->getHTMLString();
	}
	abstract public function getHTMLString();
}
