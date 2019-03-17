<?php

include 'header.php';

#include 'input.php';
include 'inputObject.php';


/*make an instance of the class, with name=name, labeltext="entername, and 
 * type="text":
 */
?>
<div class="container">
	<form method="POST" action="">
<?php
$inputTest = new Input("name", "Enter Name", "text");

//echo default input
echo $inputTest->render();

$inputTest->setData("Dan");
//echo input with successfully validated data
echo $inputTest->render();

$inputTest->setError("Invalid name");
//echo input when error has occurred
echo $inputTest->render();
?>
	</form>
</div>

include 'footer.php';

?>
