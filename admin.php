<?php
#
# This page allows admin users to login
# A logged in admin can also use this page to register new admin users1
#

include_once 'header.php';

echo "<section id='admin'>";

if(!$isAdmin){
	$adminLogin = new Form('admin-login', 'admin.php', 'POST');
	$adminLogin->setClassList("mx-auto");

	$email = new Input('email', 'Enter email: ', 'email');
	$email->setValidator("Validator::validateEmail");

	$password = new Input('password', 'Enter password', 'password');

	$password->setValidator('Validator::validatePassword');

	$adminLogin->addFields($email, $password);

	$submitBtn = new Button('admin-submit', 'login');
	$submitBtn->setClassList("btn btn-danger");

	$adminLogin->addButtons($submitBtn);
	$success = false;

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminLogin->setData();
		$adminLogin->validate();

		if(!$adminLogin->hasErrors()){
			$conn = DBConnect::getConnection();
			$sql = "SELECT * FROM admin WHERE email = '".$email->getData($conn)."';";
			$result = mysqli_query($conn, $sql);
			echo $password->getData();
			$num = mysqli_num_rows($result);			
			if($num === 1){
				$row = mysqli_fetch_array($result);
				if(password_verify($password->getData(), $row['password'])){
					$_SESSION['admin'] = true;
					$_SESSION['first_name'] = 'admin';
					$_SESSION['email'] = $row['email'];
					$success = true;
					echo "<h4 class='text-success'>Login successful! Redirecting...</h4>";
					header("Refresh:2; url='index.php'");				
				}
			}
			else echo "<h4 class='text-danger'>Error!</h4>";
			mysqli_close($conn);
		}
	}
	if(!$success){
		echo "<h4 class='text-default'>Login as admin:</h4><br/>";
		$adminLogin->render();
	}
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
	$password->setValidator("Validator::validatePassword");
	$passwordCheck = new Input('password-check', 'Confirm password', 'password');

	$adminRegister->addFields($email, $password, $passwordCheck);
	$registerButton = new Button('register');
	$adminRegister->addButtons($registerButton);

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])){
		$adminRegister->setData();
		$adminRegister->validate();
		$matching = $password->getData() === $passwordCheck->getData();
		if(!$adminRegister->hasErrors() && $matching){
			$hash = password_hash($password->getData(), PASSWORD_DEFAULT);
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
			}
		} 
		else {
	// password must be at least 8 characters
	// password must have one  non-alphanumeric character
	// password must have one number
	// password must have at least two alphabetical characters
			echo "<p class='text-info'>Password must be at least 8 characters </p>";
			echo "<p class='text-info'>Password must have at least one non-alphanumberic character </p>";
			echo "<p class='text-info'>Password must have at least one number</p>";
			echo "<p class='text-info'>Password must have at least two alphabetical characaters</p>";

		}
	}
	echo "<h4 class='mx-auto'>Register a new admin user</h4>";
	$adminRegister->render();
	mysqli_close($conn);
}
echo "</section>";
