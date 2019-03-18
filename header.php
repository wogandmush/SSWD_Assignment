<?php

ini_set('display_errors', 1);
session_start();

include 'components/Input.php';
include 'components/Select.php';
include 'components/Radio.php';
include 'components/CheckBox.php';
include 'components/TextArea.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>=Fitness Club Website</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
                <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/materia/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
			<h1><a href='index.php'>Home</a></h1>
			<nav>
				<ul>
					<li><a href="class.php">Classes</a></li>
					<li><a href="testimonial.php">Testimonials</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
			</nav>
		</header>

