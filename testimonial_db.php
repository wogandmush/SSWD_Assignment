<?php
#header("Access-Control-Allow-Origin: *");
session_start();

$_SESSION['is_admin'] = 1;
if(!$_SESSION['is_admin']){
	header('Location: index.php');
	exit();
}
else {

	include '../config/connect.php';
	
	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		$sql = "SELECT * FROM testimonial WHERE approved = 0";
	
		$result = mysqli_query($conn, $sql);
		
		$num = mysqli_num_rows($result);

		if($num > 0){
			$data = array();
			while($row = mysqli_fetch_array($result)){
				$data[] = $row;
			}		
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
			mysqli_free_result($result);

		}
		else if(isset($_POST['approve'])){

			$sql = "UPDATE testimonial SET approved = 1 WHERE first_name = '$name' AND date = '$time'";


			$result = mysqli_query($conn, $sql);
			echo $result;
			mysqli_free_result($result);

		}

	}

	mysqli_close($conn);

}
