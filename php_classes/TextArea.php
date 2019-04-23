<?php
include_once 'Field.abs.php';
class TextArea extends Field{
	public function __construct(string $name, string $label, array $attributes = array()){
		$this->name = $name;
		$this->label = $label;			
		$this->attributes = $attributes; //attributes are optional
	}
	public function getHTMLString(){
		if(!empty($this->errors)){
			$output =  "<div class='form-group'>
				<label class='text-danger' for='$this->name'>$this->label</label>";
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
		$output .= "<textarea name='$this->name' id='$this->name' class='form-control'";
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
		//thought this might give an error, but no
		$output .= ">$this->data</textarea>
				</div>";
		return $output;
	}
}
