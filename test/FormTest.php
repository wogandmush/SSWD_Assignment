<?php
include 'header.php';

$form = new Form('test-form', 'FormTest.php');

$name = new Input('name', 'Enter name: ');

$email = new Input('email', 'Enter email: ');
$email->setValidator('Validator::validateEmail', 'not a valid email');

$gender = new Radio('gender', 'Choose your gender: ');
$gender->setOptions(array('male', 'female'));
$gender->setRequired('true');

$classes = new CheckBox('classes', 'Select classes: ');
$classes->setOptions(array('Yoga'=>'yoga', 'Cardio'=>'cardio', 'Strength'=>'strength'));

$address = new TextArea('address', 'Enter address: ');
$address->setAttributes(array('maxlength'=>200));

$form->addFields($name, $email, $gender, $classes, $address);


$submit = new Button('submit');

$form->addButtons($submit);

if($_SERVER['REQUEST_METHOD'] === $form->getMethod()){
	$form->setData();
	$form->validate();
}
$form->render();

include 'footer.php';
?>
