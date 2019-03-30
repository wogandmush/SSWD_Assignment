<?php
class Form {

	private $action;
	private $method;
	private $fields;
	private $buttons;

	public function __construct($action, $method = 'POST', $fields = array(), $buttons = array()){
		$this->action = $action;
		$this->method = $method;
		$this->fields = $fields;	
		$this->buttons = $buttons;
	}
	public function getAction(){
		return $this->action;
	}
	public function setAction($action){
		$this->action = $action;
	}
	public function getMethod(){
		return $this->method;
	}
	public function setMethod($method){
		$this->method = $method;
	}
	public function addFields(){
		$fields = func_get_args();
		$this->fields += $fields;
	}
	public function addButtons(){
		$buttons = func_get_args();
		$this->buttons += $buttons;
	}
	public function validate(){
		foreach($this->fields as $field){
			$field->validate();
		}
	}
	public function setData(){
		foreach($this->fields as $field){
			$field->setData();
		}
	}
	public static function noErrors(){
		$answer = true;
		$fields = func_get_args();
		foreach($fields as $field){
			$answer &= (empty($field->getErrors()));
		}
		return $answer;
	}
	public function render(){
		echo $this->getHTMLString();		
	}
	public function getHTMLString(){
		$output = 
		"<div class='container'>
			<form method='$this->method' action='$this->action'>";
		foreach($this->fields as $field){
			$output .= $field->getHTMLString();
		}
		foreach($this->buttons as $button){
			$output .= $button->getHTMLString();
		}
		$output .=
		"	</form>
		</div>";
		return $output;
	}
}
