<?php
include_once 'OptionField.abs.php';
class CheckBox extends OptionField{
	public function __construct(string $name, string $label, array $options = array(), array $attributes = array()){
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options;
		$this->attributes = $attributes; //attributes are optional
	}
	//Override
	public function getData($conn = null){
		if($conn) //fix this to work with array
			return array_map(function($value){
				return mysqli_real_escape_string($conn, $value);
			}, $this->data);
		return $this->data;
	}
	public function setData($data = null){
		if(isset($data)){
			$this->data = array_map(function($value){
				return htmlspecialchars($value);
			}, $data);
		}
		else {
			if(isset($_POST[$this->getName()])){
				$this->data = array_map(function($value){
					return trim(htmlspecialchars($value));
				}, $_POST[$this->getName()]);
			}
		}
	}
	public function validate(){
		if(empty($this->data)){
			$this->setError('No options selected');
		}
		else{
			foreach($this->data as $datum){
				if(!in_array($datum, $this->options))
					$this->setError('Invalid option selected');
			}
		}
	}
	public function getHTMLString(){
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
