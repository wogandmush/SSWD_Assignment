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
	$testimonialForm = new Form('testimonial_add', 'testimonial_add.php');

	$testimonial = new TextArea('testimonial', "Add your testimonial: ");
	$testimonial->setAttributes(array(
		'maxlength'=>400, 
		'placeholder'=>'write your message',
		'required',
		'rows'=>5,
		'cols'=>20
	));

	// create a select element for users 
	$class = new Select('class', 'Which class did you take?');
	$class->setRequired(true);

	$classOptions = array();
	$conn = DBConnect::getConnection();
	$sql = "SELECT class_title FROM class;";
	$result = mysqli_query($conn, $sql);
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$classOptions[] = $row['class_title'];
		}
	}
	mysqli_close($conn);
	$class->setOptions($classOptions);

	$testimonialForm->addFields($testimonial, $class);

	$testimonialButton = new Button("Submit");
	$testimonialForm->addButtons($testimonialButton);

	$success = false; // if false, form will be displayed

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$testimonialForm->setData();
		$testimonialForm->validate();


		//noErrors returns false if any input object has an error
		//it can take any number of arguments
		if(!$testimonialForm->hasErrors()){
					
			$conn = DBConnect::getConnection();

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
		echo "<div class='container'>";
		$testimonialForm->render();
		echo "</div>";
	}
}
include 'footer.php';
?>
