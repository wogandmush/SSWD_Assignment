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

//default input
echo $inputTest->render();

//input with successfully validated data
$inputTest->setData("Dan");
echo $inputTest->render();

//input when error has occurred
$inputTest->setError("Invalid name");
echo $inputTest->render();
?>
	</form>
</div>
<?php
include 'footer.php';

?>
