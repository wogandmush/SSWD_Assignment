<?php
class TextArea{
	private $name; // the name attribute
	private $label; // The text for the label field
	private $attributes; // array to set things like maxlength, required, etc
	private $data; // data retrieved from GET/POST request
	private $errors; // array of errors to print out

	public function __construct(string $name, string $label, array $attributes = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->attributes = $attributes; //attributes are optional
	}
	public function setAttributes(array $attributes){ //pass in an array of attributes
		$this->attributes += $attributes;
	}
	public function getName(){
		return $this->name;
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
		$output .="	<textarea name='$this->name' id='$this->name' class='form-control'";

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

		$output .="	></textarea>
				</div>";
		return $output;
	}

/* print the sticky version of the input
 * this assumes that validated data will be added to an array
 * to a key = $name attribute of the input
 */
	elseif (!empty($this->data)){
		$output = "<div class='form-group'>
					<label class='text-success' for='$this->name'>$this->label</label>
					<textarea name='$this->name' id='$this->name' class='form-control'";
				 
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
				
				
		$output .= ">$this->data</textarea>
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
					<textarea name='$this->name' id='$this->name' class='form-control'";
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
		$output .= "></textarea>
				</div>";
		return $output;
	}

	}
}


