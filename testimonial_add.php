<?php 
include 'header.php';

if(!isset($_SESSION['user_no'])){
	header('Location: index.php');
	exit();
}
else {

	//initialize objects for each of our form fields
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
			//setData automatically call htmlspecialchars
			$testimonial->setData($_POST['testimonial');
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
		if(noErrors($class, $testimonial)){
					
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
				
				$success = true; // don't display form
			}
			else {
				echo "Error: ".mysqli_error($conn);
			}
			mysqli_close($conn);
		}
	}

	if(!$success){ // if a successful query has not been made


?>
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
