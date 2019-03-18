<?php

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
	}
	else if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$name = $_POST['name'];
		$time = $_POST['time'];

		$sql = "DELETE FROM testimonial WHERE first_name = '$name' AND date = '$time'";
		$result = mysqli_query($conn, $sql);
		echo $result;


	}

	mysqli_close($conn);

}
