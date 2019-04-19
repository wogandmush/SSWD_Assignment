<?php
# 
# The Button component is used to create a button elements for 
# forms. Each of its fields corresponds to an attribute of the html <button> tag, with the exception of the $text field, which = the inner text of the button
#
# It has getters and setters for each of its five fields
# 
# As it implements the Component interface, it also has a getHTMLString() method, and a render method, for rendering HTML to the page
#
#

class Button implements Component{
	private $name;
	private $value;
	private $text;
	private $classList = 'btn btn-primary';
	private $formAction;
	public function __construct($name, $value = null, $text = null){
		$this->name = $name;
		$this->value = isset($value) ? $value :  $name;
		$this->text = isset($text) ? $text : $this->value;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getValue(){
		return $this->value;
	}
	public function setValue($value){
		$this->value = $value;
	}
	public function getText(){
		return $this->text;
	}
	public function setText($text){
		$this->text = $text;
	}
	public function getClassList(){
		return $this->classList;
	}
	public function setClassList($classList){
		$this->classList = $classList;
	}
	public function getFormAction(){
		return $this->formAction;
	}
	public function setFormAction($formAction){
		$this->formAction = $formAction;
	}
	public function render(){
		echo $this->getHTMLString();
	}
	public function getHTMLString(){
		$output = 
		"<button 
			type='submit' 
			id='$this->name'
			class='$this->classList'
			name='$this->name'
			value='$this->value'";
		if(!empty($this->formAction)){
			$output .= " formaction='$this->formAction'";
		}
		$output .= ">$this->text</button>";

		return $output;
	}
}

