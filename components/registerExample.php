<?php
phpinfo();
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
#include 'TextArea.php'

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
$student_no->setAttributes(array('required'));

$first_name = new Input('first_name', 'First Name: ');
$first_name->setAttributes(array('required', 'maxlength'=>20));

$last_name = new Input('last_name', 'Last Name: ');
$last_name->setAttributes(array('required', 'maxlength'=>20));

$email = new Input('email', 'Email: ', 'email');
$email->setAttributes(array('required', 'maxlength'=>20));

$mobile = new Input('mobile', 'Mobile: ', 'tel');
$mobile->setAttributes(array('required', 'maxlength'=>20));

$home_tel = new Input('home_tel', 'Home Number: ', 'tel');
$home_tel->setAttributes(array('maxlength'=>20));

$date_of_birth = new Input('date_of_birth', 'Date of Birth: ', 'date');
$date_of_birth->setAttributes(array('required'));

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

$course = new Select('course', 'Course: ');
$course->setOptions(array('PhD', 'HDip', 'MSc'));
//etc
$start_date = new Input('start_date', 'Start Date: ', 'date');
$end_date = new Input('end_date', 'End Date: ', 'date');

$address = new TextArea('address', 'Address: ');
$address->setAttributes(array('placeholder' => '74 Clontarf Park'));

$study_mode = new Radio('study_mode', 'Study Mode: ');
$study_mode->setOptions(array('part_time', 'full_time'));


$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){

	// validate

	//$first_name->setData('Martin');

	//use setError or setData when validating
	// you can use the objects getName() method to dereference it's value from $_POST
	// $_POST[$gender->getName()] === $_POST['gender']
	$student_no->setData($_POST[$student_no->getName()]);
	$first_name->setData($_POST[$first_name->getName()]);
	$last_name->setData($_POST[$last_name->getName()]);
	$date_of_birth->setData($_POST['date_of_birth']);
	$gender->setData($_POST[$gender->getName()]); 
	$mobile->setData($_POST[$mobile->getName()]);
	$home_tel->setData($_POST[$home_tel->getName()]);
	$email->setData($_POST[$email->getName()]);
	$address->setData($_POST[$address->getName()]);
	$major->setData($_POST[$major->getName()]);
	$course->setData($_POST[$course->getName()]);
	$study_mode->setData($_POST[$study_mode->getName()]);
	$start_date->setData($_POST[$start_date->getName()]);
	$end_date->setData($_POST[$end_date->getName()]);

	if(noErrors(
		$student_no, 
		$first_name, 
		$last_name, 
		$date_of_birth, 
		$gender, 
		$mobile, 
		$home_tel, 
		$address, 
		$email, 
		$major, 
		$course, 
		$study_mode, 
		$start_date, 
		$end_date
	)){

		//do database stuff;
		include '../../config/connect.php';
		
		// pass $conn to $field->getData() method to call mysqli_real_escape_string

		$sql = "INSERT INTO student (
					student_no,
					first_name,
					last_name,
					date_of_birth,
					gender,
					mobile,
					home_tel,
					email,
					address,
					major,
					course,
					study_mode,
					start_date,
					end_date
				) VALUES (
					".$student_no->getData($conn).", 
					'".$first_name->getData($conn)."',
					'".$last_name->getData($conn)."',
					'".$date_of_birth->getData($conn)."',
					'".$gender->getData($conn)."',
					'".$mobile->getData($conn)."',
					'".$home_tel->getData($conn)."',
					'".$email->getData($conn)."',
					'".$address->getData($conn)."',
					'".$major->getData($conn)."',
					'".$course->getData($conn)."',
					'".$study_mode->getData($conn)."',
					'".$start_date->getData($conn)."',
					'".$end_date->getData($conn)."'
				)";
				
	
		$result = mysqli_query($conn, $sql);
		if($result){
			echo $result;
			$success = true;
		}
		else {
			echo "<h4 class='text-danger'>Error: ".mysqli_error($conn)."</h4>";
		}

	}
}
if(!$success){ //display the form if db stuff/form stuff not done
	// render

	echo "<form method='POST' action=''>
			<div class='container'>";
	
		//$object_name->render() to display the input field
		$student_no->render();
		$first_name->render();
		$last_name->render();
		$date_of_birth->render();
		$gender->render();
		$mobile->render();
		$home_tel->render();
		$email->render();
		$address->render();
		$major->render();
		$course->render();
		$study_mode->render();
		$start_date->render();
		$end_date->render();

	echo "<button class='btn btn-secondary' type='submit'>Register Student</button>
		</div>
	</form>";
}
include '../footer.php';
?>
