<?php

#
# This file handles db logic related to the contact page
#
# User submitted data is curled to knuth.griffith.ie, in order to make use of it's working mail server.
#
# If a successful response is recieved from knuth, the user's enquiry is added to the database
#

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

function forwardToMailServer($data){
	$url = "https://knuth.griffith.ie/~s2995020/Assignment/SSWD_Assignment/contact_mail.php";
	$payload = http_build_query($data);
	$curly = curl_init();
	curl_setopt($curly, CURLOPT_URL, $url);
	curl_setopt($curly, CURLOPT_POST, true);
	curl_setopt($curly, CURLOPT_POSTFIELDS, $payload);

	curl_setopt($curly, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($curly);
	return $result;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['delete'])){
		$success = Contact::deleteById($_POST['delete-key']);
		echo $success;
		if($success == 1){
			echo "<h4 class='text-success'>Your message has successfully been delisted<h4>";
		}
	}
	else if(isset($_POST['contact-submit'])){
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

			$fields = [
				'name' => $name,
				'email' => $email,
				'subject' => $subject,
				'message' => $message,
				'mobile' => $mobile,
				'remove-link' => "${_SERVER['SERVER_NAME']}$root/contact_db.php?id=$key",
				'enquiry' => true
			];
			$result = forwardToMailServer($fields);
			// curl data to knuth, to send email
			if($result == "Success!"){
				echo "<h4 class='text-secondary'>Thank you for your query. A confirmation email has been sent to $email<h4>";
				$contact->create();
				$contact->render();
			}
			else {
				echo "<h4 class='text-warning'>Something went wrong</h4>";
				echo "<p>Please try again</p>";
			}
		}
		else {
			echo "Some fields left empty";
		}
	}
	else if(isset($_POST['contact-reply'])){
		$key = $_POST['contact-reply-key'];
		$original_message = Contact::read("WHERE hashkey = '$key'")[0];
		$subject = $original_message->getSubject();
		$reply = $_POST['contact-reply-body'];
		$email = $original_message->getEmail();
		$name = $_SESSION['first_name'];		
		$fields = [
			'name' => $name,
			'reply_body' => $reply,
			'email' => $email,
			'subject' => $subject,
			'remove-link' => "${_SERVER['SERVER_NAME']}$root/contact_db.php?id=$key",
			'reply' => true
		];
		$result = forwardToMailServer($fields);
		if($result == "Success!"){
			$enquirer = $original_message->getName();
			echo "<h4 class='text-success'>Thank you for your reply! Your message has been forwarded to $enquirer</h4>";
			echo "<p class='text-secondary'>Redirecting back to enquiries page...</p>";
			header("refresh: 2;url='$root/contact_manage.php'");
			exit();
		}
				
	}
}
?>

