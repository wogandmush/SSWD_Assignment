<?php
include 'header.php';

$input = new Input("test", "This is the test");

$form = new Form('form', 'test.php');
$form->addFields($input);

$btn = new Button("submit");
$form->addButton($btn);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	var_dump($_POST);
	$input->setData($_POST['test'], false);
	$form->validate();
}
$form->render();
