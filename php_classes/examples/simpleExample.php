<?php
include '../header.php';
/*
 * Using these component classes, php forms can be written much more easily,
 * requiring much less code, and thus being much easier to debug.
 * 
 * They include built-in functionality to render error messages / data
 * depending on whether the user has submitted valid data.
 *
 */
# to use, just include the required class
# (this code is already included in the header.php file);
#include 'Input.php';
#include 'Select.php';
#include 'Radio.php';
#include 'CheckBox.php';
#include 'TextArea.php';

	### CREATING A FORM FIELD OBJECT ###

# To create a new form field, use the class' constructor method
# The constructor for each class takes a minimum 2 arguments:
# (string $name, string $label);

$fname = new Input('first_name', 'Enter your first name: ');

# the first is the name attribute, by which the field is identified when
# a form has been submitted

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$fname = $_POST['first_name']; // the first argument above
}

# the second argument is the inner text to be displayed within the label tags
# which accompany the input
# i.e. the example Input above will render as (abbreviated):
#	<label for="first_name">Enter your first name: </label>
#	<input name="first_name" id="first_name" type="text" />

# the constructor method also takes some optional arguments, which differ depending
# on the type.
# e.g. in the case of the Input class:

$email = new Input('email', 'Enter your email: ', 'email');

# - the third argument is the type attribute of the input (set to 'text' by default);


# to set other input attributes, such as maxlength, pattern, etc, use the 
# setAttributes() method, which takes an array of key/value pairs. eg:

$attributes = array("maxlength"=>20, "required");
$fname->setAttributes($attributes);

# you can also pass in an anonymous array directly.

$email->setAttributes(array("maxlength"=>30));

# you can used the setRequired() method, which takes a boolean

$email->setRequired(false);


	### RENDERING THE FORM FIELD ###

# To have the field appear in a form, use the render() method, e.g.
?>

<form method="POST" action="simpleExample.php">
	<?php
	$fname->render();
	$email->render();
	?>
	<button type="submit">Submit</button>
</form>

<?php

	### VALIDATING FORM DATA ###

# When validating, use the setData() and setError() methods, e.g.

if(!isset($_POST['first_name'])){
	$fname->setError('First name is a required field');
}
else {
	$fname->setData($_POST['first_name']);
// or
	$fname->setData($_POST[$fname->getName()]); // === $_POST['first_name']
}

# note that setData() calls the htmlspecialchars and trim methods by default.
# for custom validation, you can assign the data to a temporary variable before calling setData

if(isset($_POST['email'])){
	$temp = $_POST['email'];
	if($temp = filter_var($temp, FILTER_VALIDATE_EMAIL)){
		$email->setData($temp);
	}
	else {
		$email->setError("Entered invalid email address");
	}
}

	### BUILDING QUERY STRINGS ###
	
# After validation, use an if / else statement to determine whether to show the form
# again, or whether to proceed to database logic.
# For convenience, you can use the noErrors method:
#
# include 'noErrors.php' // included in header.php

if(Form::noErrors($fname, $email)){ //simply load all of you fields into this function

# when building your query string, use the getData() method.
# passng in the connection variable calls the mysqli_real_escape_string() method,
# escaping characters such as apostrophes which may cause your query to fail

	include '../../config/connect.php';

	$sql = "INSERT INTO simpleExample (
				first_name,
				email)
			VALUES (
				'".$fname->getData($conn)."', // be careful when concatenating
				'".$email->getData($conn)."'
			)";
	echo $sql;
}
else {

	// render the form (as shown above)
	// error messages and sticky data will be rendered automatically
}

/*
 * See registerExample.php for a more complete example of field components in use
 */
