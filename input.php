<?php
/*
 * Maybe we could use this kind of function to make reusable code to generate forms
 *
 * The classnames added are to make it work with bootstrap, but that can obviously be changed
 * Lemme know what you think
 *  - Dan
 */


ini_set('display_errors', 1);


function input(string $name, string $label, string $type, array $options = null, array $data = null, array $errors = null){

	/*  print version of form with error warning 
	 *  This assumes that errors will be stored in an array
	 *  during validation, to a key = $name attribute of the input
	 */
	if(isset($errors[$name])){
		return "<div class='form-group'>
					<label for='$name'>$label</label>
					<small class='text-danger'>${errors[$name]}</small>
					<input type=$type />
				</div>";
	}

	/* print the sticky version of the input
	 * this assumes that validated data will be added to an array
	 * to a key = $name attribute of the input
	 */
	elseif (!empty($data)){
		return "<div class='form-group'>
					<label class='text-success' for='$name'>$label</label>
					<input type=$type value=${data[$name]} />
				</div>";
	}
	else {
		/* if both errors and data are unset for this field, just print the 
		 * default form
		 * This such as required, maxlength etc can be stored in an options array
		 */
		return "<div class='form-group'>
					<label for='$name'>$label</label>
					<input type='$type' />
				</div>";
	}
}

echo input("UserId", "Insert User Id:", "text", array(), array(), ['UserIp' => 'bugger']);
