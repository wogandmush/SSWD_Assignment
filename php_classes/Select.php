<?php
class Select extends OptionField{
	public function __construct(string $name, string $label, array $options = array(), array $attributes = array()){
		//$this->name  === this.name in java
		$this->name = $name;
		$this->label = $label;			
		$this->options = $options; // labeltext => value
		$this->attributes = $attributes; //attributes are optional
	}
	public function getHTMLString(){
		if(!empty($this->errors)){
			$output =  "<div class='form-group'>
				<label class='text-danger' for='$this->name'>$this->label </label>";
			foreach($this->errors as $error){
				$output .= "<small class='text-danger'>$error</small>";
			}
		}
		elseif (!empty($this->data)){
			$output = "<div class='form-group'>
						<label class='text-success' for='$this->name'>$this->label</label>";
		}
		else {
			$output = "<div class='form-group'>
						<label for='$this->name'>$this->label</label>";
		}
		$output .= "<select name='$this->name' id='$this->name' class='form-control' ";
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
		$output .=">";
		foreach($this->options as $label=>$value){

			if(is_numeric($label)){			
				if(isset($this->data) && $this->data === $value){
					$output .= "<option selected='selected'>$value</option>";
				}
				else {
					$output .= "<option>$value</option>";
				}
			}
			else {
				if(isset($this->data) && $this->data === $value){
					$output .= "<option selected='selected' value=\"$value\">$label</option>";
				}
				else {
					$output .= "<option value=\"$value\">$label</option>";
				}
			}
		}
		$output .= "</select>
				</div>";
		return $output;
	}
}
