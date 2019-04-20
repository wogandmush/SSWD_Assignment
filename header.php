<?php

ob_start(); // Turn on output buffering - place HTML etc. into buffer until end of script
session_start(); // start session to track data for user over pages

spl_autoload_register(function($class_name){
	include __DIR__.'/components/'.$class_name .'.php';
});

$isMember = isset($_SESSION['email']);
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;

// 
$root = PathHelper::getRoot(); //creates a variable to access the absolute root directory of the project
$fsRoot = PathHelper::getFSRoot(); //file system root 

###for testing###
#$_SESSION['admin'] = true;
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
		<link rel="stylesheet" href="<?php echo $root;?>/css/reset.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
		<!--<link rel="stylesheet" href="css/stylefees.css">-->

		<link rel="stylesheet" href="<?php echo $root;?>/css/style.css">
		<link rel="stylesheet" href="<?php echo $root;?>/css/Footer.css">
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
                        <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="<?php echo $root;?>/class.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Classes </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="yogaclass.php">Yoga</a>
                          <a class="dropdown-item" href="strengthclass.php">Strength</a>
                          <a class="dropdown-item" href="cardioclass.php">Cardio</a>
                            <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="class.php">Schedule</a>           
                        </div>    
						</li>
 <!--                       
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $root;?>/class.php">Classes</a>
						</li>
<!--
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $root?>/fees.php">Fees</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $root?>/testimonial.php">Testimonials</a>
						</li>
-->
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $root?>/contact.php">Contact Us</a>
						</li>
                    
                         
					</ul>
					<?php 
					if(isset($_SESSION['first_name'])){
					echo "<h5 class='text-secondary my-2 mr-lg-2'>logged in as ${_SESSION['first_name']}</h5>
					<form action='$root/logout.php'>
						<button class='btn btn-warning ml-auto'>Logout</button>
					</form>";
					}
					else {
						echo "<button onclick='location.href=\"${root}/register.php\";' type='button' class='btn btn-link' id='register-link'>JOIN</button>";
						echo "<button type='button' class='btn btn-link' id='login-link'>MEMBERS</button>";
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
											WHERE email = '".$loginEmail->getData($conn)."';";

								$result = mysqli_query($conn, $sql);
								$num_rows = mysqli_num_rows($result);								
								if($num_rows === 1){
									$tuple = mysqli_fetch_array($result, MYSQLI_ASSOC);
									if(password_verify($loginPassword->getData(), $tuple['password'])){
										$_SESSION['user_no'] = $tuple['user_no'];
										$_SESSION['first_name'] = $tuple['first_name'];
										$_SESSION['email'] = $tuple['email'];
										$_SESSION['membership'] = $tuple['membership'];
										$loginSuccess = true;
										header('Refresh: 0');
										mysqli_close($conn);
										exit();
									}
								}
								else $loginEmail->setError('Incorrect email or password');
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
		var loginLinkText = $('#login-link').html();
		$('#login-form').hide();

		$('#login-link').on("click", toggleLogin);
			
		
		function toggleLogin(){
			if($('#login-link').html() == loginLinkText){
				$('#login-link').html("&times;");
				$('#register-link').toggle();
				$('#login-form').slideToggle(200);
			}
			else {
				$('#login-form').slideToggle(200, ()=>{
					$('#login-link').html(loginLinkText);
					$('#register-link').toggle();
				});
			}
		};
<?php 
if(isset($loginForm) && $loginForm->hasErrors())
	echo "toggleLogin();";
?>
			</script>
		</header>
		<main>
<?php
include 'admin_toolbar.php';
