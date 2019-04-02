<?php

include '../header.php';

$testForm = new Form('test', 'Test4.php');
$phone_no = new Input('phone_no', 'Enter a phone number', 'tel');
$testForm->addFields($phone_no);
$button = new Button('phone_no_test', 'Test Phone Number');
$testForm->addButtons($button);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone_no'])){
	$testForm->setData();
	$testForm->validate();

	if(Validator::validatePhoneNumber($phone_no->getData()))
		echo "<h4 class='text-success'>That is a valid phone number!</h4>";
	else echo "<h4 class='text-warning'>Invalid phone number</h4>";

}

$testForm->render();
include '../footer.php';
