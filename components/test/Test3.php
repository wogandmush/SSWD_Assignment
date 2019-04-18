<?php

include '../header.php';

$form = new Form('test-form', 'Test3.php', 'POST');
$name = new Input('name', 'Enter name: ');
$name->setValidator('Validator::validateEmail', 'Everything is fucked');
$button = new Button('submit');
$button->setClassList("btn btn-secondary");
$form->addField($name);
$form->addButton($button);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$form->setData();
	$form->validate();
}

$form->render();
