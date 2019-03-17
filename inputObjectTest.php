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
$inputTest = new Input("name", "Enter Name", "text");
$inputTest->setOptions(array('placeholder' => "E.g. John Doe", 'required'=>true));

//default input
$inputTest->render();

//input with successfully validated data
$inputTest->setData("Dan");
$inputTest->render();

//input when error has occurred
$inputTest->setError("Invalid name");
$inputTest->render();
?>
	</form>
</div>
<?php
include 'footer.php';

?>
