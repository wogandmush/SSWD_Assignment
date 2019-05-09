<?php
include 'header.php';

$id = $_GET['id'];
$contactMessage = Contact::read("WHERE hashkey = '$id'")[0];
$contactMessage->render();

$contactReplyForm = new Form('contact-db.php');

$contactBody = new TextArea('contact-reply-body', 'Enter the body of your reply');
$contactId = new Input('contact-reply-key', '', 'hidden');
$contactId->setData($id);
$contactReplyForm->addFields($contactId, $contactBody);
$contactReplySubmit = new Button('contact-reply', 'send');
$contactReplySubmit->setClassList('btn btn-primary');
$contactReplyForm->addButton($contactReplySubmit);

$contactReplyForm->render();
