<?php

include 'header.php';

$name = new Input("name", "Name: ");
$email = new Input("email", "Email: ", "email");
$subject = new Input("subject", "Subject: ");
$message = new TextArea("message", "Write your message here");

echo "<form action='mail.php' method='POST'>";
$name->render();
$email->render();
$subject->render();
$message->render();
echo "<button class='btn btn-primary'>Send</button";
echo "</form";
/*
 */



include 'footer.php';

?>
