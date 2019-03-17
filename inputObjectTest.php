<?php

include 'header.php';

#include 'input.php';
include 'inputObject.php';

?>
<div class="container">
	<form method="POST" action="">
<?php

/*make an instance of the class, with name=name, labeltext="entername, and 
 * type="text":
 */
/*
$inputTest = new Input("name", "Enter Name", "text");
$inputTest->setAttributes(array('placeholder' => "E.g. John Doe", 'required'=>true));

//default input
$inputTest->render();

//input with successfully validated data
$inputTest->setData("Dan");
$inputTest->render();

//input when error has occurred
$inputTest->setError("Invalid name");
$inputTest->render();
 */


include './selectObject.php';

$selectTest = new Select("favorite_movie", "Select your favorite movie");

$selectTest->setOptions(array("Mrs Doubtfire", "star_wars"=>"Star Wars"));
$selectTest->render();

$selectTest->setData("star_wars");
$selectTest->render();

$selectTest->setError("uh oh");
$selectTest->render();

?>


	</form>
</div>
<?php
include 'footer.php';



?>

