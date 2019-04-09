<?php
#header("Access-Control-Allow-Origin: *");
session_start();
ini_set('display_errors', 1);
spl_autoload_register(function($class_name){
	include __DIR__.'/components/'.$class_name.'.php';
});

if(!(isset($_SESSION['membership']) && $_SESSION['membership'] === 'admin')){
	echo "<h4 class='text-danger'>Unauthorized request made. Redirecting...</h4>";
	header("refresh: 2; url: 'index.php'");
	exit();
}
else {
 if($_SERVER['REQUEST_METHOD'] === 'POST'){ //delete doesn't seem to work

		$name = $_POST['name'];
		$time = $_POST['time'];

		$testimonial = new Testimonial($name, "", "", $time);

		if(isset($_POST['delete'])){
			echo $testimonial->delete();
		}
		else if(isset($_POST['approve'])){

			echo $testimonial->update('approved', 1);
		}
	}
}


