<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['enquiry'])){
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
	else if(isset($_POST['reply'])){
		
		$first_name = $_POST['name'];
		$reply_body = $_POST['reply_body'];
		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$content =<<<EOT

$first_name has replied to your message PerfectForm Fitness:

Subject: Re:$subject
Message: 
	$reply_body

If you wish to remove your message, please click the link below:
$removeLink
EOT;

		$hostEmail = "swole@fit.ie";

		$mailHeader = "From: $hostEmail \r\n";

		$email_sent = mail($email, "$first_name has replied to your message!", $content, $mailHeader);

		if($email_send){
			echo "Success!";
			exit();
		}
		else{
			echo "Fail!";
			exit();
		}
	}
}
