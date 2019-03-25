<?php
include_once 'OptionField.abs.php';
class Radio extends OptionField{
	public function __construct(string $name, string $label, array $options = array(), array $attributes = array()){
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options;
		$this->attributes = $attributes; //attributes are optional
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
								name='$this->name'
								type='radio'
								value='$value'";
			if(isset($this->data) && $this->data === $value) {
				$output .= " checked='checked' ";
			}
			if(in_array('required', $this->attributes)){
				$output .= ' required ';
			}
			$output .= ">";
			if(is_numeric($label)){
							$output .= "<label class='form-check-label' for='$this->name-$value'>$value</label>
							</div>";
			}
			else {
				// add code for 'is required' here
							$output .=" <label class='form-check-label' for='$this->name-$value'>$label</label>
							</div>";
			}
		}
		$output .= "</div>";
		return $output;
	}
}
