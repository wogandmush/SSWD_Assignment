<?php

#
# This file displays all enquiries submitted by site visitors, so that
# logged in members can read them.
# Each enquiry comes with a link, which allows members to reply to enquiries
#

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
