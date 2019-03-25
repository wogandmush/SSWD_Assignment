<?php
if(isset( $_POST['name']))
$name = $_POST['name'];
if(isset( $_POST['email']))
$recipient = $_POST['email'];
if(isset( $_POST['message']))
$message = $_POST['message'];
if(isset( $_POST['subject']))
$subject = $_POST['subject'];
$email = "swole@fit.ie";

$content="From: $name \n Email: $email \n Message: $message";
$mailheader = "From: $email \r\n";

mail($recipient, $subject, $content, $mailheader) or die("Error!");
echo "Email sent!";
?>

