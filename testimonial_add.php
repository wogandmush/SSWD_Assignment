<?php 
include 'header.php';

# for testing purposes
$_SESSION['first_name'] = 'Dan';
$_SESSION['user_no'] = 1;

if(!isset($_SESSION['user_no'])){
	header('Location: index.php');
	exit();
}
else {

	$testimonial = new TextArea('testimonial', "Add your testimonial: ");
	$testimonial->setAttributes(array(
		'maxlength'=>200, 
		'placeholder'=>'write your message',
		'required',
		'rows'=>5,
		'cols'=>20
	));
	$class = new Select('class', 'Which class did you take?');
	$class->setAttributes(array(
		'required',
	));
	$class->setOptions(array(
		'Hot Yoga',
		'Pilates',
		'Aerobics'
	));

	$success = false; // if false, form will be displayed

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		if(empty($_POST['testimonial'])){
			$testimonial->setError("Text Area was left blank");
		}
		else{
			$temp = $_POST['testimonial'];
			//validate
			$testimonial->setData($temp);
		}

		if(empty($_POST['class'])){
			$class->setError('Please choose a class');
		}
		else {
			$temp = $_POST['class'];
			//validate
			$class->setData($temp);
		}
				
		include '../config/connect.php';
		$class_name = mysqli_real_escape_string($conn, $class->getData());
		$message = mysqli_real_escape_string($conn, $testimonial->getData());
		$sql = "INSERT INTO testimonial(first_name, class_name, message) VALUES(
			'${_SESSION['first_name']}',
			'$class_name',
			'$message'
			)";
		#echo $sql;
		if($result = mysqli_query($conn, $sql)){
			echo "Testimonial submitted for approval";
			
			// if ! success, form will be display;
			$success = true;
		}
		else {
			echo "Error: ".mysqli_error($conn);
		}
		mysqli_close($conn);
	}

	if(!$success){


?>
<div class="container">
	<div class="column mx-auto">
		<form method="POST" action="#">
<?php
	$testimonial->render();
	$class->render();
?>
			<button class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>





















<?php
	}
}
include 'footer.php';
?>
