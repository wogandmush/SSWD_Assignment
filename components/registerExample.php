<?php
/* 
 * An abridged version of lab5, using objects
 *
 * Hopefully this will show how much easier it is to make forms with these objects.
 *
 * Don't forget to pass in options and attributes as arrays
 *
 */
include '../header.php';

#include 'Input.php'; //import the Input class
#include 'Radio.php'; //import the Radio class
#include 'Select.php'; //import the Select class
#include 'CheckBox.php'; //import the CheckBox class

//initiate objects before validating
/*
 * Input constuctor needs three arguments:
 *  - Name: the name attribute, by which the input value will be 
 *  dereferenced from the $_POST superglobal
 *
 *  - Label: the text to go inside the field's label tags
 *
 *  - Type: the type of input, e.g. text, number, date, email, etc.
 *
 * 	A fourth argument 'Attributes' is also optional.
 * 	This takes an array of key value pairs to set as the inputs attributes
 * 	E.g. array('maxlength'=>20, 'required'=>true);
 * 	To keep the code tidy, I used the class' setAttributes method to
 * 	do the same thing
 */
$student_no = new Input('student_no', 'Student number: ', 'number');
$student_no->setAttributes(array('required'=>true));

$first_name = new Input('first_name', 'First Name: ', 'text');
$first_name->setAttributes(array('required'=>true, 'maxlength'=>20));

$date_of_birth = new Input('date_of_birth', 'Date of Birth: ', 'date');
$date_of_birth->setAttributes(array('required'=>true));

/*
 * The Radio class' constructor takes at least two arguments, Name and Label;
 * The third optional argument is 'Options', which should be an array.
 * Options can be indexed or not. 
 *
 * If indexed, the key is the label text, and the value is set is the value sent* i.e. setOptions(array($labelText=>$value));
 *
 * Otherwise, the value and label text will both be set to the array value
 *
 * The fourth optional argument is Attributes, similar to above
 */

$gender = new Radio('gender', 'Gender: ');
$gender->setOptions(array('Male'=>'male', 'female'));

/*
 * Select takes the same arguments as radio
 */

$major = new Select('major', 'Major: ');
$major->setOptions(array('Computer Science', 'Business', 'Journalism'));

//etc

$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){

	// validate

	//$first_name->setData('Martin');

	//use setError or setData when validating
	$date_of_birth->setError('Not a valid date of birth');
	// you can use the objects getName() method to dereference it's value from $_POST
	// $_POST[$gender->getName()] === $_POST['gender']
	$gender->setData($_POST[$gender->getName()]); 
	$major->setData($_POST[$major->getName()]);
	$first_name->setData($_POST[$first_name->getName()]);
	$student_no->setData($_POST[$student_no->getName()]);

	if(noErrors($date_of_birth, $gender, $major, $first_name, $student_no)){

		//do database stuff;

		$success = true;

	}
}
if(!$success){ //display the form if db stuff/form stuff not done
	// render

	echo "<form method='POST' action=''>
			<div class='container'>";
	
		//$object_name->render() to display the input field
		$student_no->render();
		$first_name->render();
		$date_of_birth->render();
		$gender->render();
		$major->render();

	echo "<button class='btn btn-secondary' type='submit'>Register Student</button>
		</div>
		</form>";
}
include '../footer.php';
?>
