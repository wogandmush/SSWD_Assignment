<?php

include 'init.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	var_dump($_POST);
	$name;
	$email;
	$message;
	$mobile;
	$subject;

	if(isset( $_POST['contact-name']))
		$name = $_POST['contact-name'];
	if(isset( $_POST['contact-email']))
		$email = $_POST['contact-email'];
	if(isset( $_POST['contact-subject']))
		$subject = $_POST['contact-subject'];
	if(isset( $_POST['contact-mobile']))
		$mobile = $_POST['contact-mobile'];
	if(isset( $_POST['contact-message']))
		$message = $_POST['contact-message'];
	$hostEmail = "swole@fit.ie";
	if(!(empty($name) || empty($email) || empty($message) || empty($subject))){

		$contact = new Contact($name, $email, $subject, $message, $mobile);
		$key = $contact->getKey();
		echo $key;
		$contact->create();

		$content="From: $name \n Email: $email \n Message: $message";
		/*
		$mailheader = "From: $hostEmail \r\n";

		$email_sent = mail($email, $subject, $content, $mailheader);// o die("Error!");
		if($email_sent) {
			echo "Email sent!";
		}
		 */
	}
	else {
		echo "Some fields left empty";
	}

	//var_dump(error_get_last());
}
?>

