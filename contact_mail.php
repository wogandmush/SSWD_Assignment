<?php

include 'header.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	if(!isset($_GET['id'])){
		echo "<h4 class='text-warning'>Invalid link. Redirecting...</h4>";
		header("refresh: 3; url='$root/index.php'");
		exit();
	}

	echo "<h4 class='text-warning'>Are you sure you want to delist your message?</h4>";
	$deleteForm = new Form('contact-delete');
	$deleteKey = new Input('delete-key', '', 'hidden');
	$deleteKey->setData($_GET['id']);
	$deleteButton = new Button('delete');
	$deleteForm->addField($deleteKey);
	$deleteForm->addButton($deleteButton);
	$deleteForm->render();
}

//var_dump($_SERVER);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['delete'])){
		$success = Contact::deleteById($_POST['delete-key']);
		echo $success;
		if($success == 1){
			echo "<h4 class='text-success'>Your message has successfully been delisted<h4>";
		}
	}


	else if(isset($_POST['contact-submit'])){
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

			$content =<<<EOT

From: $name
Email: $email

Thank you for your enquiry.
Your message will be made visible to our members
Subject: $subject
Message: $message

If you wish to remove you message click the link below:
${_SERVER['SERVER_NAME']}$root/contact_mail?id=$key

EOT;
			echo $content;
			$mailheader = "From: $hostEmail \r\n";

			$email_sent = mail($email, "Thank you for your enquiry", $content, $mailheader);// o die("Error!");
			if($email_sent) {
				echo "Email sent!";
			}
		}
		else {
			echo "Some fields left empty";
		}
		//var_dump(error_get_last());
	}
}
?>

