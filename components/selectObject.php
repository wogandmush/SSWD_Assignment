<?php
class Select{
	private $name; // the name attribute
	private $label; // The text for the label field
	private $options; //array of options
	private $attributes; // array to set things like maxlength, required, etc
	private $data; // data retrieved from GET/POST request
	private $errors; // array of errors to print out

	public function __construct($name, $label, $options = array(), $attributes = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options;
		$this->attributes = $attributes; //attributes are optional
	}
	public function setAttributes($attributes){ //pass in an array of attributes
		$this->attributes += $attributes;
	}
	public function setOptions($options){
		$this->options += $options;
	}
	public function getOptions(){
		return $this->options;	
	}
	public function removeOption($option){
		unset($this->options[$option]);
	}
	public function getData(){
		return $this->data;
	}
	public function setData($data){
		$this->data = $data;
	}
	public function setError($error){
		$this->errors[] = $error;
	}
	public function render(){
		echo $this->getString();
	}

	public function getString(){

	if(!empty($this->errors)){
		$output =  "<div class='form-group'>
			<label class='text-danger' for='$this->name'>$this->label</label>";

		foreach($this->errors as $error){
			$output .= "<small class='text-danger'>$error</small>";
		}

		$output .="	<select id='$this->name' class='form-control' ";

		if(!empty($this->attributes)){
			foreach($this->attributes as $key=>$value){
				if ($key === 'required'){
					$output .='required ';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}

		$output .=">";

		foreach($this->options as $value=>$text){

			if(is_numeric($value)){			
				$output .= "<option>$text</option>";
			}
			else {
				$output .= "<option value='$value'>$text</option>";
			}
		}

		$output .= "</select>
				</div>";


		return $output;
	}

	elseif (!empty($this->data)){
		$output = "<div class='form-group'>
					<label class='text-success' for='$this->name'>$this->label</label>
					<select id='$this->name' class='form-control' ";
				 
		if(!empty($this->attributes)){
			foreach($this->attributes as $key=>$value){
				if ($key === 'required'){
					$output .='required ';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}
				
		$output .=">";

		foreach($this->options as $value=>$text){

			if(is_numeric($value)){			
				if($this->data === $text){
					$output .= "<option selected='selected'>$text</option>";
				}
				else {
					$output .= "<option>$text</option>";
				}
			}
			else {
				if($this->data === $value){
					$output .= "<option value='$value' selected='selected'>$text</option>";
				}
				else{
					$output .= "<option value='$value'>$text</option>";
				}
			}
		}

		$output .= "</select>
				</div>";
				
		return $output;
	}
	else {
		/* if both errors and data are unset for this field, just print the 
		 * default form
		 * This such as required, maxlength etc can be stored in an attributes array
		 */
		$output = "<div class='form-group'>
					<label for='$this->name'>$this->label</label>
					<select id='$this->name' class='form-control' ";
		if(!empty($this->attributes)){
			foreach($this->attributes as $key=>$value){
				if ($key === 'required'){
					$output .='required ';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}	 
		$output .=">";

		foreach($this->options as $value=>$text){

			if(is_numeric($value)){			
				$output .= "<option>$text</option>";
			}
			else {
				$output .= "<option value='$value'>$text</option>";
			}
		}

		$output .= "</select>
				</div>";

		return $output;
	}

	}
}


