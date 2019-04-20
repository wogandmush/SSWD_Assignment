<?php
class Form implements Component{

	private $id;
	private $action;
	private $method;
	private $enctype;
	private $fields;
	private $buttons;
	private $classList = 'form';

	public function __construct($id, $action = '', $method = 'POST', $enctype = "", $fields = array(), $buttons = array()){
		$this->id = $id;
		$this->action = empty($action) ? $_SERVER['REQUEST_URI'] : $action;
		$this->method = $method;
		$this->enctype = $enctype;
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
	public function getEnctype(){
		return $this->enctype;
	}
	public function setEnctype($enctype){
		$this->enctype = $enctype;
	}
	public function addField($field){
		$this->fields[$field->getName()] = $field;
	}
	public function addFields(){
		$fields = func_get_args();
		foreach($fields as $field){
			$this->fields[$field->getName()] = $field;
		}
	}
	public function getFields(){
		return $this->fields;
	}
	public function addButton($button){
		$this->buttons[] = $button;
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
	public function hasErrors(){
		foreach($this->fields as $field){
			if(!empty($field->getErrors())){
				return true;
			}
		}
		return false;
	}
	public function setClassList(string $classList){
		$this->classList = $classList;
	}
	public static function noErrors(){
		$answer = true;
		$fields = func_get_args();
		foreach($fields as $field){
			$answer &= (empty($field->getErrors()));
		}
		return $answer;
	}
	public static function renderForwardPOST(){
		foreach($_POST as $key => $value){
			echo "<input type='hidden' name='$key' value='$value' />";			
		};
	}
	public function forwardPOST(){
		$components = array();
		foreach($_POST as $key=>$value){
			$component = new Input($key, '', 'hidden');		
			$component->setData($value);
			$this->fields[$key] = $component;
		}
	}
	public function render(){
		echo $this->getHTMLString();		
	}
	public function getHTMLString(){
		$output = 
			"<form id='$this->id' class='$this->classList' method='$this->method' action='$this->action'
enctype='$this->enctype'>";
		foreach($this->fields as $field){
			$output .= $field->getHTMLString();
		}
		foreach($this->buttons as $button){
			$output .= $button->getHTMLString();
		}
		$output .=
		"	</form>";
		return $output;
	}
}
