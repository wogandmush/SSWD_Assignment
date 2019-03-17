<?php

include 'header.php';

#include 'input.php';
include 'inputObject.php';

/*make an instance of the class, with name=name, labeltext="entername, and 
 * type="text":
 */
$inputTest = new Input("name", "Enter Name", "text");

//echo default input
echo $inputTest->render();

$inputTest->setData("Dan");
//echo input with successfully validated data
echo $inputTest->render();

$inputTest->setError("Invalid name");
//echo input when error has occurred
echo $inputTest->render();

include 'footer.php';

?>
