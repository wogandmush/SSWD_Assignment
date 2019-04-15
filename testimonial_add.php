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

	$message = new TextArea('testimonial', "Add your testimonial: ");
	$message->setAttributes(array(
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

	$testimonialForm->addFields($message, $class);

	$testimonialButton = new Button("Submit");
	$previewButton = new Button("preview");
	$previewButton->setClassList("btn btn-info");
	$testimonialForm->addButtons($testimonialButton, $previewButton);


	$success = false; // if false, form will be displayed

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$testimonialForm->setData();
		$testimonialForm->validate();


		//noErrors returns false if any input object has an error
		//it can take any number of arguments
		if(!$testimonialForm->hasErrors()){
			if(isset($_POST['preview'])){
?>
<section id='testimonials'>
	   	<div class='container' id='testimonial-container'>
<?php

				$preview = new Testimonial($_SESSION['first_name'], $message->getData(), $class->getData(), date("M,d,Y h:i:s"));
				$preview->render();
				//var_dump($preview->toArray());

				echo 
					"<form method='POST' action='testimonial_db.php'>";
				Form::forwardPOST();
				echo 
					"<input type='hidden' name='first_name' value='${_SESSION['first_name']}'>
					<input class='btn btn-primary' type='submit' name='create' value='create' />
					</form>";
						
								
?>
	</div>
</section>
<?php
				var_dump($_POST);

				$success = true;
			}
					
			else {

			$conn = DBConnect::getConnection();

			// insert a new tuple into table 'testimonial' (approved = 0; i.e. not approved);
			// passing connection variable to component's getData() method calls mysqli_real_escape_string()
			// on data value and returns it
			$sql = "INSERT INTO testimonial(first_name, class_title, message) VALUES(
				'${_SESSION['first_name']}',
				'".$class->getData($conn)."', 
				'".$message->getData($conn)."'
				)";
			#echo $sql; // for testing

			if($result = mysqli_query($conn, $sql)){ // if query was successful
				echo "Thank you! Your testimonial has been submitted!";
				echo "<p class='text-info'>Redirecting to testimonials page</p>";
				$success = true; // don't display form
				$url = $root."/testimonial.php";
				header("Refresh: 2; url='$url'");
				exit();
				}
			else {
				echo "Something went wrong";
			}
			// close the db connection
			mysqli_close($conn);
			}
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
