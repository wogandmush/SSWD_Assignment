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
include 'inputObject.php';
include 'radioObject.php';
include 'selectObject.php';

//initiate objects before validating
$student_no = new Input('student_no', 'Student number: ', 'number');
$student_no->setAttributes(array('required'=>true));

$first_name = new Input('first_name', 'First Name: ', 'text');
$first_name->setAttributes(array('required'=>true, 'maxlength'=>20));

$date_of_birth = new Input('date_of_birth', 'Date of Birth: ', 'date');
$date_of_birth->setAttributes(array('required'=>true));

$gender = new Radio('gender', 'Gender: ');
$gender->setOptions(array('male', 'female'));

$major = new Select('major', 'Major: ');
$major->setOptions(array('Computer Science', 'Business', 'Journalism'));

//etc

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	// validate

	//$first_name->setData('Martin');
	var_dump($_POST);

	$date_of_birth->setError('Not a valid date of birth');
	//$gender->setData($_POST['gender']);
	$major->setData('Computer Science');
	$first_name->setData($_POST['first_name']);
	$student_no->setData($_POST['student_no']);
}

	// render

	echo "<form method='POST' action=''>
			<div class='container'>";
	
		$student_no->render();
		$first_name->render();
		$date_of_birth->render();
		//$gender->render();
		$major->render();

	echo "<button type='submit'>Register Student</button>
		</div>
		</form>";

include '../footer.php';
?>
