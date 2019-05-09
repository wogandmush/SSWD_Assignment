<?php
include 'header.php';

$contactMessages = Contact::read();

if(is_array($contactMessages)){
	foreach($contactMessages as $message){
		$message->render();
	}
}
