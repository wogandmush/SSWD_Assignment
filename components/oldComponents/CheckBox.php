<?php
class CheckBox{
	private $name; // the name attribute
	private $label; // The text for the label field
	private $options; //array of options
	private $attributes; // array to set things like maxlength, required, etc
	private $data; // data retrieved from GET/POST request
	private $errors; // array of errors to print out
	public function __construct(string $name, string $label, array $options = array(), array $attributes = array()){
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options;
		$this->attributes = $attributes; //attributes are optional
	}
	public function getName(){
		return $this->name;
	}
	public function setName(string $name){
		$this->name = $name;
	}
	public function getData($conn = null){
		if($conn) //fix this to work with array
			return array_map(function($value){
				return mysqli_real_escape_string($conn, $value);
			}, $this->data);
		return $this->data;
	}
	public function setData($data){
		$this->data = array_map(function($value){
			return htmlspecialchars($value);
		}, $data);
	}
	public function getErrors(){
		return $this->errors;
	}
	public function setError($error){
		$this->errors[] = $error;
	}
	public function getOptions(){
		return $this->options;	
	}
	public function setOptions(array $options){
		$this->options += $options;
	}
	public function removeOption($option){
		unset($this->options[$option]);
	}
	public function getAttributes(){
		return $this->attributes;
	}
	public function setAttributes(array $attributes){ //pass in an array of attributes
		$this->attributes += $attributes;
	}
	public function isRequired(bool $which){
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
		echo $this->getString();
	}
	public function getString(){
		if(!empty($this->errors)){
			$output =  "<div class='form-group'>
				<label class='text-danger'>$this->label</label>";
			foreach($this->errors as $error){
				$output .= "<small class='text-danger'>$error</small>";
			}
		}
		elseif (!empty($this->data)){
			$output = "<div class='form-group'>
						<label class='text-success'>$this->label</label>";
		}
		else {
			$output = "<div class='form-group'>
						<label>$this->label</label>";
		}
		foreach($this->options as $label=>$value){
			$output .= "<div class='form-check'>
							<input 
								class='form-check-input' 
								id='$this->name-$value'
								name='$this->name[]'
								type='checkbox'
								value='$value'";
			if(isset($this->data) && in_array($value, $this->data)) {
				$output .= " checked='checked' ";
			}
			if(in_array('required', $this->attributes)){
					$output .= " required ";
			}
			$output.= "	>";
			if(is_numeric($label)){
				$output .= "	<label class='form-check-label' for='$this->name-$value'>$value</label>
							</div>";
			}
			else {
                $output .= "	<label class='form-check-label' for='$this->name-$value'>$label</label>
							</div>";
			}
		}
		$output .= "</div>";
		return $output;
	}
}
