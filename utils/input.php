<?php
/*
 * Maybe we could use this kind of function to make reusable code to generate forms
 * Lemme know what you think
 *  - Dan
 */

ini_set('display_errors', 1);
function input(string $name, string $label, string $type, array $options = null, array $data = null, array $errors = null){

	if(isset($errors[$name])){
		return "<div class='form-group'>
					<label for='$name'>$label</label>
					<small class='text-danger'>${errors[$name]}</small>
					<input type=$type />
				</div>";
	}
	elseif (!empty($data)){
		return "<div class='form-group'>
					<label for='$name'>$label</label>
					<input type=$type value=${data[$name]} />
				</div>";
	}
	else {
		return "<div class='form-group'>
					<label for='$name'>$label</label>
					<input type='$type' />
				</div>";
	}
}

echo input("UserId", "Insert User Id:", "text", array(), array(), ['UserIp' => 'bugger']);
