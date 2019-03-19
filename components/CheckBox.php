<?php
class CheckBox{
	private $name; // the name attribute
	private $label; // The text for the label field
	private $options; //array of options
	private $attributes; // array to set things like maxlength, required, etc
	private $data; // data retrieved from GET/POST request
	private $errors; // array of errors to print out

	public function __construct(string $name, string $label, array $options = array(), array $attributes = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options;
		$this->attributes = $attributes; //attributes are optional
	}
	public function getName(){
		return $this->name;
	}
	public function setAttributes(array $attributes){ //pass in an array of attributes
		$this->attributes += $attributes;
	}
	public function getAttributes(){
		return $this->attributes;
	}
	public function setOptions(array $options){
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
		$this->data = htmlspecialchars($data);
	}
	public function getErrors(){
		return $this->errors;
	}
	public function setError($error){
		$this->errors[] = $error;
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

		foreach($this->options as $label=>$value){
			if(is_numeric($label)){
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$value'
									name='$this->name[]'
									type='checkbox'
									value='$value'";
				if(in_array('required', $this->attributes)){
					$output .= " required ";
				}
				$output .= ">
								<label class='form-check-label' for='$this->name-$value'>$value</label>
							</div>";
			}
			else {
				// add code for 'is required' here
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$value'
									name='$this->name[]'
									type='checkbox'
									value='$value'";
				if(in_array('required', $this->attributes)){
						$output .= " required ";
				}

				$output .= ">
								<label class='form-check-label' for='$this->name-$value'>$label</label>
							</div>";
			}
		}
		$output .= "</div>";


		return $output;
	}

	elseif (!empty($this->data)){
		$output = "<div class='form-group'>
					<label class='text-success'>$this->label</label>";

		foreach($this->options as $label=>$value){
			if(is_numeric($label)){
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$label'
									name='$this->name[]'
									type='checkbox'
									value='$value'";
				if(in_array($label, $this->data)) {
					$output .= " checked='checked' ";
				}
				if(in_array('required', $this->attributes)){
						$output .= " required ";
				}
				$output .= ">
								<label class='form-check-label' for='$this->name-$value'>$value</label>
							</div>";
			}
			else {
				// add code for 'is required' here
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$value'
									name='$this->name[]'
									type='checkbox'
									value='$value'";
				if(in_array($value, $this->data)) {
					$output .= " checked='checked' ";
				}
				if(in_array('required', $this->attributes)){
					$output .= " required ";
				}
				$output .= ">
								<label class='form-check-label' for='$this->name-$value'>$label</label>
							</div>";
			}
		}

		$output .= "</div>";
				
		return $output;
	}
	else {
		/* if both errors and data are unset for this field, just print the 
		 * default form
		 * This such as required, maxlength etc can be stored in an attributes array
		 */
		$output = "<div class='form-group'>
					<label>$this->label</label>";

		foreach($this->options as $label=>$value){
			if(is_numeric($label)){
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$value'
									name='$this->name[]'
									type='checkbox'
									value='$value'";

				if(in_array('required', $this->attributes)){
						$output .= " required ";
				}
				$output.= "	>
								<label class='form-check-label' for='$this->name-$value'>$value</label>
							</div>";
			}
			else {
				$output .= "<div class='form-check'>
								<input 
									class='form-check-input' 
									id='$this->name-$value'
									name='$this->name[]'
									type='checkbox'
									value='$value'";
				if(in_array('required', $this->attributes)){
						$output .= " required ";
				}

				$output .= ">
								<label class='form-check-label' for='$this->name-$value'>$label</label>
							</div>";
			}
		}
			$output .= "</div>";

			return $output;


		}

	}
}


