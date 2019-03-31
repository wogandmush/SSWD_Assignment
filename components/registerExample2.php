<?php
include '../header.php';
$registerForm = new Form('register_form', 'registerExample2.php');
$student_no = new Input('student_no', 'Student number: ', 'number');
$student_no->setAttributes(array('required'));
$first_name = new Input('first_name', 'First Name: ');
$first_name->setAttributes(array('required', 'maxlength'=>20));
$last_name = new Input('last_name', 'Last Name: ');
$last_name->setAttributes(array('required', 'maxlength'=>20));
$email = new Input('email', 'Email: ', 'email');
$email->setAttributes(array('required', 'maxlength'=>20));
$email->setValidator('Validator::validateEmail', 'invalid email entered');
$mobile = new Input('mobile', 'Mobile: ', 'tel');
$mobile->setAttributes(array('required', 'maxlength'=>20));
$home_tel = new Input('home_tel', 'Home Number: ', 'tel');
$home_tel->setAttributes(array('maxlength'=>20));
$date_of_birth = new Input('date_of_birth', 'Date of Birth: ', 'date');
$date_of_birth->setAttributes(array('required'));
$date_of_birth->setValidator('Validator::validateDate', 'Invalid date');
$gender = new Radio('gender', 'Gender: ');
$gender->setOptions(array('Male'=>'male', 'female'));
$major = new Select('major', 'Major: ');
$major->setOptions(array('Computer Science', 'Business', 'Journalism'));
$course = new Select('course', 'Course: ');
$course->setOptions(array('PhD', 'HDip', 'MSc'));
$start_date = new Input('start_date', 'Start Date: ', 'date');
$start_date->setValidator('Validator::validateDate', 'Invalid date');
$end_date = new Input('end_date', 'End Date: ', 'date');
$end_date->setValidator('Validator::validateDate', 'Invalid date');
$address = new TextArea('address', 'Address: ');
$address->setAttributes(array('placeholder' => '74 Clontarf Park'));
$study_mode = new Radio('study_mode', 'Study Mode: ');
$study_mode->setOptions(array('Part Time'=>'part_time', 'Full Time'=>'full_time'));
$registerForm->addFields($student_no, $first_name, $last_name,	$date_of_birth,	$gender, $home_tel, $mobile, $address, $email, $major,	$course, $study_mode, $start_date, $end_date);
$registerButton = new Button('register');
$registerButton->setClassList('btn btn-info');
$registerForm->addButton($registerButton);
$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$registerButton->getName()])){
	$registerForm->setData();
	$registerForm->validate();
	if(!$registerForm->hasErrors()){
		include '../../config/connect.php';
		$sql = "INSERT INTO student (student_no, first_name, last_name, date_of_birth, gender, mobile, home_tel, email,	address, major,	course,	study_mode,	start_date,	end_date) VALUES (".$student_no->getData($conn).", '".$first_name->getData($conn)."','".$last_name->getData($conn)."',	'".$date_of_birth->getData($conn)."', '".$gender->getData($conn)."', '".$mobile->getData($conn)."',	'".$home_tel->getData($conn)."', '".$email->getData($conn)."',	'".$address->getData($conn)."',	'".$major->getData($conn)."',	'".$course->getData($conn)."', '".$study_mode->getData($conn)."',	'".$start_date->getData($conn)."', '".$end_date->getData($conn)."')";
		$result = mysqli_query($conn, $sql);
		if($result)	$success = true;
		else echo "<h4 class='text-danger'>Error: ".mysqli_error($conn)."</h4>";
		mysqli_close($conn);
	}
}
if(!$success){ 
	echo "<div class='container'>";
	$registerForm->render();
	echo "</div>";
}
include '../footer.php';
?>
