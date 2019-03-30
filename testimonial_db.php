<?php
#header("Access-Control-Allow-Origin: *");
session_start();


if(!(isset($_SESSION['membership']) && $_SESSION['membership'] === 'admin')){
	echo "<h4 class='text-danger'>Unauthorized request made. Redirecting...</h4>";
	header("refresh: 2; url: 'index.php'");
	exit();
}
else {

	include '../config/connect.php';
	// get request made from testimonial_manage.php
	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		// sql string to retrieve all unapproved testimonial messages
		$sql = "SELECT * FROM testimonial WHERE approved = 0";

		$result = mysqli_query($conn, $sql);
		
		$num = mysqli_num_rows($result);

		// if the query returns any results
		if($num > 0){
			// create an array into which we can load our object
			$data = array();
			// loop through each row
			// $row = associative array (col_name=>value)
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				// load each $row into the $data array
				$data[] = $row;
			}		
			// send our data array back to testimonial_manage.php as a json object
			// (makes it easier to manipulate with javascript
			echo json_encode($data);
		}
		mysqli_free_result($result);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'POST'){ //delete doesn't seem to work

		$name = $_POST['name'];
		$time = $_POST['time'];

		if(isset($_POST['delete'])){

			$sql = "DELETE FROM testimonial WHERE first_name = '$name' AND date = '$time'";
			$result = mysqli_query($conn, $sql);
			echo $result;
		}
		else if(isset($_POST['approve'])){

			$sql = "UPDATE testimonial SET approved = 1 WHERE first_name = '$name' AND date = '$time'";

			$result = mysqli_query($conn, $sql);
			echo $result;
		}
	}
	mysqli_close($conn);
}


