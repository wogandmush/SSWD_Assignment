<?php
include 'header.php';

if(!$isAdmin){
	$adminLogin = new Form('admin-login', 'admin.php', 'POST');
	$adminLogin->setClassList("mx-auto");

	$email = new Input('email', 'Enter email: ', 'email');
	$email->setValidator("Validator::validateEmail");

	$password = new Input('password', 'Enter password', 'password');
	function validatePassword($pwd){
	return true;
	}
	$password->setValidator('validatePassword');

	$adminLogin->addFields($email, $password);

	$submitBtn = new Button('login');
	$submitBtn->setClassList("btn btn-danger");

	$adminLogin->addButtons($submitBtn);

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminLogin->setData();
		$adminLogin->validate();

		if(!$adminLogin->hasErrors()){
			$conn = DBConnect::getConnection();
			$sql = "SELECT * FROM admin WHERE email = '".$email->getData($conn)."';";
			$result = mysqli_query($conn, $sql);
			$num = mysqli_num_rows($result);			
			if($num === 1){
				$row = mysqli_fetch_array($result);
				echo $row['password'];
				if(password_verify($password->getData(), $row['password'])){
					$_SESSION['admin'] = true;
					$_SESSION['first_name'] = 'admin';
					$_SESSION['email'] = $row['email'];
					header("Refresh:2; url='index.php'");				
				}
			}
			else echo "<h4 class='text-danger'>Error!</h4>";

			mysqli_close($conn);
		}
		
	}
	$adminLogin->render();
}
if($isAdmin){
	$conn = DBConnect::getConnection();
	$sql = "SELECT email FROM admin";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "<h4>List of current admins</h4>";
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<p>${row['email']}</p>";
		}
	}

	$adminRegister = new Form('admin-register', 'admin.php', 'POST');
	$adminRegister->setClassList('mx-auto');

	$email = new Input('email', 'Enter email', 'email');
	$password = new Input('password', 'Enter password', 'password');
	$passwordCheck = new Input('password-check', 'Confirm password', 'password');

	$adminRegister->addFields($email, $password, $passwordCheck);
	$registerButton = new Button('register');
	$adminRegister->addButtons($registerButton);

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])){
		$adminRegister->setData();
		$adminRegister->validate();
		echo $password->getData();
		echo $passwordCheck->getData();
		$matching = $password->getData() === $passwordCheck->getData();
		if(!$adminRegister->hasErrors() && $matching){
			$hash = password_hash($password->getData(), PASSWORD_DEFAULT);
			echo $hash;
			$sql = "INSERT INTO admin VALUES ('".$email->getData($conn)."', '$hash');";
			$result = mysqli_query($conn, $sql);
			if($result){
				echo "<h4 class='text-success'>Added new admin user</h4>";
				mysqli_close($conn);
				header("Refresh:2; url='admin.php'");
				exit();
			}
			else {
				echo "<h4 class='text-warning'>Something went wrong</h4>";
				echo mysqli_error($conn);
			}
		}
	}
	echo "<h4 class='mx-auto'>Register a new admin user</h4>";
	$adminRegister->render();
	mysqli_close($conn);
}
