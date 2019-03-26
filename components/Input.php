<?php
include_once 'Field.abs.php';
class Input extends Field{
	private $type; // text, email, tel, password
	public function __construct(string $name, string $label, string $type = "text", array $attributes = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->type = $type;
		$this->attributes = $attributes; //attributes are optional
	}
	public function getType(){
		return $this->type;
	}
	public function setType(string $type){
		$this->type = $type;
	}
	public function getHTMLString(){
		if(!empty($this->errors)){
			$output =  "<div class='form-group'>
				<label class='text-danger' for='$this->name'>$this->label</label>";

			foreach($this->errors as $error){
				$output .= "<small class='text-danger'>$error</small>";
			}
			$output .="	<input name='$this->name' id='$this->name' class='form-control' type=$this->type ";
		}
		elseif (!empty($this->data)){
			$output = "<div class='form-group'>
						<label class='text-success' for='$this->name'>$this->label</label>
						<input name='$this->name' id='$this->name' class='form-control' type='$this->type' value='$this->data' ";
		}
		else {
			//print default form
			$output = "<div class='form-group'>
						<label for='$this->name'>$this->label</label>
						<input name='$this->name' id='$this->name' class='form-control' type='$this->type' ";
		}
		if(!empty($this->attributes)){
			foreach($this->attributes as $key=>$value){
				if ($value === 'required'){
					$output .='required ';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}	 
		$output .= "/>
				</div>";
		return $output;
	}
}
