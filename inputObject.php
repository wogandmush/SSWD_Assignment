<?php
ini_set('display_errors', 1);
class Input{
	private $name;
	private $label;
	private $type;
	private $options;
	private $data;
	private $errors;

	public function __construct($name, $label, $type, $options = array()){
		$this->name = $name;
		$this->label = $label;			
		$this->type = $type;
		$this->options = $options;
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
		$output .="	<input type=$this->type />
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
					<input type=$this->type value=$this->data />
				</div>";
		return $output;
	}
	else {
		/* if both errors and data are unset for this field, just print the 
		 * default form
		 * This such as required, maxlength etc can be stored in an options array
		 */
		return "<div class='form-group'>
					<label for='$this->name'>$this->label</label>
					<input type='$this->type' />
				</div>";
	}

	}
}


