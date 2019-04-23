<?php
include '../header.php';


?>
<div class="container">
	<form method="POST" action="">
<?php

/*make an instance of the class, with name=name, labeltext="entername, and 
 * type="text":
 */

$inputTest = new Input("name", "Enter Name", "password");
$inputTest->setAttributes(array('placeholder' => "E.g. John Doe", 'required'=>true));

//default input
$inputTest->render();

//input with successfully validated data
$inputTest->setData("Dan");
$inputTest->render();

//input when error has occurred
$inputTest->setError("Invalid name");
$inputTest->render();



$selectTest = new Select("favorite_movie", "Select your favorite movie");

$selectTest->setOptions(array("Mrs Doubtfire", "Star Wars"=>"star_wars"));
$selectTest->render();

$selectTest->setData("star_wars");
$selectTest->render();

$selectTest->setError("uh oh");
$selectTest->render();


$radioTest = new Radio("gender", "Gender: ");
$radioTest->setRequired(true);
$radioTest->setOptions(array("male", "female"));
$radioTest->render();

$radioTest->setData('female');
$radioTest->setRequired(false);
$radioTest->render();

$radioTest->setError('not a flying toy');
$radioTest->render();


$checkTest = new CheckBox('interests', 'Select your interests: ');
$checkTest->setAttributes(array('required'));
$checkTest->setOptions(array("Music", "Drinking", "Fishing"));


$checkTest->setData(array("Music", "Drinking"));
$checkTest->render();

$checkTest->setError("What did you do?!");
$checkTest->render();

$testArea = new TextArea('address', 'Enter Address: ');
//$testArea->setData("This is the data");

$testArea->render();

?>

		<button type="submit">Submit</button>

	</form>
</div>
<?php
include '../footer.php';



?>

