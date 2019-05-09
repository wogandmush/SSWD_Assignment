<?php
include 'header.php';

$id = $_GET['id'];
$contactMessage = Contact::read("WHERE hashkey = '$id'")[0];
$contactMessage->render();

$contactReplyForm = new Form('contact-reply');

$contactBody = new TextArea('contact-reply-body', 'Enter the body of your reply');

$contactReplyForm->addFields($contactBody);
$contactReplySubmit = new Button('contact-reply', 'send');
$contactReplySubmit->setClassList('btn btn-primary');
$contactReplyForm->addButton($contactReplySubmit);
$contactReplyForm->render();
