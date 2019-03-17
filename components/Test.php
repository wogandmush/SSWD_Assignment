<?php

include '../header.php';

include 'Input.php';

?>
<div class="container">
	<form method="POST" action="">
<?php

/*make an instance of the class, with name=name, labeltext="entername, and 
 * type="text":
 */

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


include './Select.php';

$selectTest = new Select("favorite_movie", "Select your favorite movie");

$selectTest->setOptions(array("Mrs Doubtfire", "star_wars"=>"Star Wars"));
$selectTest->render();

$selectTest->setData("star_wars");
$selectTest->render();

$selectTest->setError("uh oh");
$selectTest->render();

include 'Radio.php';

$radioTest = new Radio("gender", "Gender: ");
$radioTest->setOptions(array("male", "female"));
$radioTest->render();

$radioTest->setData('female');
$radioTest->render();

$radioTest->setError('not a flying toy');
$radioTest->render();

include 'CheckBox.php';

$checkTest = new CheckBox('interests', 'Select your interests: ');
$checkTest->setOptions(array("Music", "Drinking", "Fishing"));


if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$checkTest->setData($_POST[$checkTest->getName()]);
}
$checkTest->render();

$checkTest->setError("What did you do?!");
$checkTest->render();

?>

		<button type="submit">Submit</button>

	</form>
</div>
<?php
include '../footer.php';



?>

