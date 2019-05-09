<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$removeLink = $_POST['remove-link'];

$content =<<<EOT

From: $name
Email: $email

Thank you for your enquiry.
Your message will be made visible to our staff and members, who will get in touch shortly!
Subject: $subject
Message: $message

If you wish to remove you message click the link below:
$removeLink
EOT;

$hostEmail = "swole@fit.ie";
$mailHeader = "From: $hostEmail \r\n";

$email_sent = mail($email, "Thank you for your enquiry!", $content, $mailHeader);

if($email_sent)
	echo "Success!";
else 
	echo "Fail!";
}
