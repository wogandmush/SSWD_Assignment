<?php 
include 'header.php';

if(!isset($_SESSION['first_name'])){
	//if user not logged in, redirect them to main page
	header('Location: index.php');
	//end script
	exit();
}
else {

	#initialize objects for each of our form fields
	// create a textarea element for user to write their message
	$testimonial = new TextArea('testimonial', "Add your testimonial: ");
	$testimonial->setAttributes(array(
		'maxlength'=>200, 
		'placeholder'=>'write your message',
		'required',
		'rows'=>5,
		'cols'=>20
	));

	// create a select element for users 
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
			$testimonial->setError("Message was left blank");
		}
		else{
			//setData automatically call htmlspecialchars
			$testimonial->setData($_POST['testimonial']);
		}

		if(empty($_POST['class'])){
			$class->setError('Please choose a class');
		}
		else if(!in_array($_POST['class'], $class->getOptions())){
			$class->setError('Not a valid value for class');
		}
		else {
			$class->setData($_POST['class']);
		}


		//noErrors returns false if any input object has an error
		//it can take any number of arguments
		if(Form::noErrors($class, $testimonial)){
					
			include '../config/connect.php';

			// insert a new tuple into table 'testimonial' (approved = 0; i.e. not approved);
			// passing connection variable to component's getData() method calls mysqli_real_escape_string()
			// on data value and returns it
			$sql = "INSERT INTO testimonial(first_name, class_name, message) VALUES(
				'${_SESSION['first_name']}',
				'".$class->getData($conn)."', 
				'".$testimonial->getData($conn)."'
				)";
			#echo $sql; // for testing

			if($result = mysqli_query($conn, $sql)){ // if query was successful
				echo "Thank you! Your testimonial has been submitted!";
				$success = true; // don't display form
			}
			else {
				echo "Something went wrong";
			}
			// close the db connection
			mysqli_close($conn);
		}
	}

	if(!$success){ // if a successful query has not been made


?>
<!-- some div elements for bootstrap formatting -->
<div class="container">
	<div class="column mx-auto">
		<form method="POST" action="#">
<?php
		/*
		 * $testimonial->render() = 
		 * <div class="form-group>
		 * <label for='testimonial'>Add your testimonial</label>
		 * <textarea name='testimonial' id='testimonial class='form-control' rows=5 cols=20 maxlength=200 placeholder='write your message' required></textarea>
		 * </div>
		 *
		 * Also displays error message, and is sticky
		 *
		 * As you can see, using objects make writing forms MUCH easier
		 *
		 */
	$testimonial->render();
	//so concise!
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
