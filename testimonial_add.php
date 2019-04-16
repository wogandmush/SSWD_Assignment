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

	$submitButton = new Button("Submit");
	$previewButton = new Button("preview");
	$previewButton->setClassList("btn btn-info");
	$testimonialForm->addButtons($submitButton, $previewButton);

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
				$success = true;
			}
			else {
				$newTestimonial = new Testimonial($_SESSION['first_name'], $message->getData(), $class->getData());
				if($newTestimonial->create()){
					echo "<h4 class='text-success'>Great Success</h4>";
					$success = true;
					header("refresh: 2; url='$root/testimonial.php");	
				}
			}
		}
	}
	if(!$success){ // if a successful query has not been made
		echo "<div class='container'>";
		$testimonialForm->render();
		echo "</div>";
?>
<script>
var textArea = document.querySelector("textarea");
var maxLength = textArea.getAttribute("maxlength");
var remainingChars = document.createElement("span");
remainingChars.className = "word-count";
remainingChars.textContent = `${maxLength}/${maxLength} characters remaining`;
textArea.parentElement.insertBefore(remainingChars, textArea);
textArea.addEventListener("keyup", e => {
	remainingChars.textContent = `${maxLength - textArea.value.length}/${maxLength} characters remaining`;
});
console.log(textArea);
</script>
<?php
	}
}
include 'footer.php';
?>
