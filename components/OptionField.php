<?php

abstract class OptionField extends Field{
	protected $options; //array of options
	public function getOptions(){
		return $this->options;	
	}
	public function setOptions(array $options){
		$this->options += $options;
	}
	public function removeOption($option){
		unset($this->options[$option]);
	}
}
