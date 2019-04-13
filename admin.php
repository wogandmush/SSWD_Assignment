<?php
include 'header.php';
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
			if($row['password'] === $password->getData($conn)){
				$_SESSION['admin'] = true;
				$_SESSION['first_name'] = 'admin';
				$_SESSION['email'] = $row['email'];
				header("Refresh:2; url='index.php'");				
			}
		}
		else echo "<h4> class='text-danger'>Error!</h4>";
	}
	
}

$adminLogin->render();

