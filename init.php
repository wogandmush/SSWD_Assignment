<?php
ob_start(); // Turn on output buffering - place HTML etc. into buffer until end of script
session_start(); // start session to track data for user over pages

spl_autoload_register(function($class_name){
	include __DIR__.'/php_classes/'.$class_name .'.php';
});

###for testing###
//ini_set('display_errors', 1);
/*
$_SESSION['admin'] = true;
$_SESSION['first_name'] = 'James';
$_SESSION['user_no'] = 1;
$_SESSION['email'] = 'dan@poo';
 */
#################

$isMember = isset($_SESSION['email']);
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;

$root = PathHelper::getRoot(); //creates a variable to access the absolute root directory of the project
$fsRoot = PathHelper::getFSRoot(); //file system root 

?>
