<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened


$first_name = new Input('first_name', 'Enter first name: ', 'date');
$first_name->setAttributes(array(
	"maxlength"=>20,
));


if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$value = $_POST['first_name'];
	//$first_name->setError("Invalid name");
	$first_name->setData($value);
}



?>
<form method="POST" action="demo.php">
	<?php
		$first_name->render();
	?>
	<button type="submit">Submit</button>
<form>





<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
