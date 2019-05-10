<?php

include 'init.php';

ini_set('display_errors', 1);

$form = new Form('form');
$input = new Input('test', 'Enter password');
$input->setValidator("Validator::validatePassword");
$input->setDefaultError("Not good");
$form->addField($input);
$btn = new Button('submit');
$form->addButton($btn);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$form->setData();
	$form->validate();
}

$form->render();
