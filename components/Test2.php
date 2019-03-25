<?php 
ini_set('display_errors', 1);
include 'Input2.php';
include 'Radio2.php';
include 'CheckBox2.php';
include 'Select2.php';
include 'TextArea2.php';
$test = new Input('test', 'Im a test!');

$radioTest = new Radio('radio', "I'm the radio test!");
$radioTest->setOptions(array('Option 1', 'Option2'));

$checkTest = new CheckBox('check', 'Check Test');
$checkTest->setOptions(array('male', 'Female'=>'female'));
$checkTest->setData(array('female', 'male'));
var_dump($checkTest->getData());

$selectTest = new Select('select', 'I\'m the select test');
$selectTest->setOptions(array('Option1', 'Option2'));

$areaTest = new TextArea('text-area', 'I\'m the text area test');
$test->render();
$radioTest->render();
$checkTest->render();
$selectTest->render();
$areaTest->render();
