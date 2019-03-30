<?php

ini_set('display_errors', 1);
class Example {
	private $name;
	public function __get($propertyName){
		return "No value";
	}
	public function __set($propertyName, $value){
		echo "You can't do that<br/>";
	}
	public function getName(){
		return $this->name;
	}
	public function pooPants($name){
		$this->name = $name;
	}
}

$object = new Example();

$object->name = "dan";

$object->pooPants("Dan");

echo $object->getName();
