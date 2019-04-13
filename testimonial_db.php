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

	 	var_dump($_POST);
		$name = $_POST['first_name'];
		$time = $_POST['date'];

		$testimonial = new Testimonial($name, "", "", $time);

		if(isset($_POST['action'])){
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
	}
}

