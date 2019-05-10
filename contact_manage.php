<?php
include 'header.php';

echo "<section id='contact-manage'>";
$contactMessages = Contact::read();

if(is_array($contactMessages)){
	foreach($contactMessages as $message){
		$message->render();
	}
}
echo "</section>";
include 'footer.php';
