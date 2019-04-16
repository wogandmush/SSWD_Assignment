<?php
#header("Access-Control-Allow-Origin: *");
session_start();
ini_set('display_errors', 1);
spl_autoload_register(function($class_name){
	include __DIR__.'/components/'.$class_name.'.php';
});

if(!(isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE)){
	echo "<h4 class='text-danger'>Unauthorized request made. Redirecting...</h4>";
	header("refresh: 2; url: 'index.php'");
	exit();
}
else {
 if($_SERVER['REQUEST_METHOD'] === 'POST'){ //delete doesn't seem to work

		if(isset($_POST['action'])){
		$name = $_POST['first_name'];
		$time = $_POST['date'];
		$testimonial = new Testimonial($name, "", "", $time);
			switch($_POST['action']){
				case 'delete': 
					echo $testimonial->delete();
					break;
				case 'approve':
					echo $testimonial->update('approved', 1);
					break;
				case 'unapprove':
					echo $testimonial->update('approved', 0);
					break;
				default:
				   	echo "error";
					break;
			}
		}
		elseif(isset($_POST['create'])){
			var_dump($_POST);
			$message = $_POST['testimonial'];
			$class = $_POST['class'];
			$name = $_POST['first_name'];
			$testimonial = new Testimonial($name, $message, $class);
			var_dump($testimonial->toArray());
			echo $testimonial->create();
			header("Location: testimonial.php");
			exit();
		}
	}
}

