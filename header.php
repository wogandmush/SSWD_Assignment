<?php

session_start();

spl_autoload_register(function($class_name){
	include __DIR__.'/components/'.$class_name .'.php';
});

$root = PathHelper::getRoot();

###for testing###
#$_SESSION['membership'] = 'admin';
#$_SESSION['first_name'] = 'Dan';
#$_SESSION['user_no'] = 1;
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>=Fitness Club Website</title>
		<link rel="stylesheet" href="css/reset.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
		<!--<link rel="stylesheet" href="css/stylefees.css">-->

		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href='<?php echo $root;?>'>Home</a>
				<button class="navbar-toggler" type="button" id="navbar-toggler"> 
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class=" collapse navbar-collapse" id="nav-div">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
						<a class="nav-link" href="<?php echo $root;?>/class.php">Classes</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="<?php echo $root?>/fees.php">Fees</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="<?php echo $root?>/testimonial.php">Testimonials</a>
						</li>
					<?php 
					if(!isset($_SESSION['user_no'])){
					?>
						<li class="nav-item">
						<a class="nav-link" href="<?php echo $root?>/register.php">Register</a>
						</li>
					<?php
					}
					?>
						<li class="nav-item">
						<a class="nav-link" href="<?php echo $root?>/contact.php">Contact Us</a>
						</li>
					</ul>
					<?php 
					if(isset($_SESSION['user_no'])){
					echo "<h5 class='text-secondary my-2 mr-lg-2'>logged in as ${_SESSION['first_name']}</h5>
					<form action='$root/logout.php'>
						<button class='btn btn-warning ml-auto'>Logout</button>
					</form>";
						if($_SESSION['membership'] == 'Admin'){
						echo "<button class='btn btn-warning ml-auto'>Special Admin Button</button>";
						}
					}
					else {
echo "<a id='login-link'>Already a member?</a>";
						$loginSuccess = false;
						$loginForm = new Form('login-form', '');
						$loginForm->setClassList('hidden form-inline');
						$loginEmail = new Input('login_email', '', 'email');
						$loginEmail->setAttributes(array(
							'placeholder'=>'Email',
							'required'));
						$loginEmail->setValidator('Validator::validateEmail', 'Email invalid');
						$loginPassword = new Input('login_password', '', 'password');
						$loginPassword->setAttributes(array(
							'placeholder'=>'Password',
							'required'));
						$loginForm->addFields($loginEmail, $loginPassword);
						$loginButton = new Button('login');
						$loginForm->addButtons($loginButton);
						if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$loginButton->getValue()])){
							$loginForm->setData();
							$loginForm->validate();
							if(!$loginForm->hasErrors()){
								$conn = DBConnect::getConnection();
								$sql = "SELECT * FROM member 
											WHERE email = '".$loginEmail->getData($conn)."' 
											AND password = '".$loginPassword->getData($conn)."';";

								$result = mysqli_query($conn, $sql);
								$num_rows = mysqli_num_rows($result);								
								if($num_rows === 1){
									$tuple = mysqli_fetch_array($result, MYSQLI_ASSOC);
									$_SESSION['user_no'] = $tuple['user_no'];
									$_SESSION['first_name'] = $tuple['first_name'];
									$_SESSION['email'] = $tuple['email'];
									$_SESSION['membership'] = $tuple['membership'];
									$loginSuccess = true;
									header('Refresh: 0');
									mysqli_close($conn);
									exit();
								}
								mysqli_close($conn);
							}
						}
						if(!$loginSuccess){
							$loginForm->render();
						}
					}
					?>
				</div>
			</nav>
			<script>
				$('#navbar-toggler').click( _=> {
					$('#nav-div').toggle(400, _ => {
						$('#nav-div').toggleClass("show");
					});
				});

		$('#login-form').hide();
		$('#login-link').on("click", ()=>{
			$('#login-link').hide();
			$('#login-form').slideToggle(200);
		});
			</script>
		</header>
