<?php

ini_set('display_errors', 1);
include 'Validator.php';
include 'Form.php';
include 'Button.php';
include 'Input.php';

$form = new Form('Test3.php', 'POST');
$name = new Input('name', 'Enter name: ');
$name->setValidator('Validator::validateEmail');
$button = new Button('submit');
$form->addField($name);
$form->addButton($button);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$form->setData();
	$form->validate();
}

$form->render();
