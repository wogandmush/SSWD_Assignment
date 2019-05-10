<?php
include 'header.php';
if(!$isMember){
	header("Location: index.php");
	exit();
}

echo "<section id='contact-manage'>";
$contactMessages = Contact::read();

if(is_array($contactMessages)){
	foreach($contactMessages as $message){
		$message->render();
	}
}
echo "</section>";
include 'footer.php';
