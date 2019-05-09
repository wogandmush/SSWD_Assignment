<?php

include 'header.php';


$contactForm = new Form('contact-form', 'contact_example.php', 'POST');

$contactName = new Input('contact-name', 'Enter your name: ', 'text');
$contactEmail = new Input('contact-email', 'Enter your email: ', 'email');
$contactEmail->setValidator('Validator::validateEmail');

$contactSubmit = new Button('contact-submit', 'submit');

$contactForm->addFields($contactName, $contactEmail);
$contactForm->addButtons($contactSubmit);
$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$contactSubmit->getName()])){

	$contactForm->setData();
	$contactForm->validate();

	if(!$contactForm->hasErrors()){
		$success = true;
		echo "<h4 class='text-success'>Success!</h4>";
	}
}
if(!$success){
	$contactForm->render();
}
