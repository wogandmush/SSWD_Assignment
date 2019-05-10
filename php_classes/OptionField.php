<?php

#
# This is an abstract class, which is extended by form elements components which contain several options, i.e.: 
#  - Select.php
#  - CheckBox.php
#  - Radio.php
#
# Each of these fields will have an options field, which will hold an array of options to display
#
#

include_once 'Field.abs.php';
abstract class OptionField extends Field{
	protected $options; //array of options
	public function getOptions(){
		return $this->options;	
	}
	public function setOptions(array $options){
		$this->options += $options;
	}
	public function validate(){
		if(!in_array($this->data, $this->options))
			$this->setError('Invalid option');
	}
	public function removeOption($option){
		unset($this->options[$option]);
	}
}
