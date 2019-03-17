<?php
ini_set('display_errors', 1);
class Input{
	private $name; // the name attribute
	private $label; // The text for the label field
	private $type; // text, email, tel, password
	private $options; // array to set things like maxlength, required, etc
	private $data; // data retrieved from GET/POST request
	private $errors; // array of errors to print out

	public function __construct($name, $label, $type, $options = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->type = $type;
		$this->options = $options; //options are optional
	}
	public function getData($data){
		return $this->data;
	}
	public function setData($data){
		$this->data = $data;
	}
	public function setError($error){
		$this->errors[] = $error;
	}

	public function render(){

	if(!empty($this->errors)){
		$output =  "<div class='form-group'>
			<label class='text-danger' for='$this->name'>$this->label</label>";

		foreach($this->errors as $error){
			$output .= "<small class='text-danger'>$error</small>";
		}
		$output .="	<input id='$this->name' class='form-control' type=$this->type ";

		if(!empty($this->options)){
			foreach($this->options as $key->$value){
				if ($key === 'required'){
					$output .='required';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}

		$output /="	/>
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
					<input id='$this->name' class='form-control' type=$this->type value=$this->data ";
				 
		if(!empty($this->options)){
			foreach($this->options as $key->$value){
				if ($key === 'required'){
					$output .='required';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}
				
				
				"	/>
				</div>";
		return $output;
	}
	else {
		/* if both errors and data are unset for this field, just print the 
		 * default form
		 * This such as required, maxlength etc can be stored in an options array
		 */
		$output = "<div class='form-group'>
					<label for='$this->name'>$this->label</label>
					<input id='$this->name' class='form-control' type='$this->type' ";
		if(!empty($this->options)){
			foreach($this->options as $key->$value){
				if ($key === 'required'){
					$output .='required';
				}
				else{
					$output .= "$key='$value' ";
				}
			}
		}	 
		$output .= "/>
				</div>";
	}

	}
}


