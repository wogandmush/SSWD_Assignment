<?php

session_start();

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

		
		<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
  
  
      <link rel="stylesheet" href="css/stylefees.css">

		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href='index.php'>Home</a>
				<button class="navbar-toggler" type="button" id="navbar-toggler"> 
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class=" collapse navbar-collapse" id="nav-div">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="class.php">Classes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="fees.php">Fees</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="testimonial.php">Testimonials</a>
						</li>
					<?php 
					if(empty($_SESSION['user_no'])){
					?>
						<li class="nav-item">
							<a class="nav-link" href="register.php">Register</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					<?php
					}
					?>
						<li class="nav-item">
							<a class="nav-link" href="contact.php">Contact Us</a>
						</li>
					</ul>
					<?php 
					if(isset($_SESSION['user_no'])){
					echo "<button class='btn btn-success ml-auto'>logged in as ${_SESSION['first_name']}</button>
					<form action='logout.php'>
						<button class='btn btn-warning ml-auto'>Logout</button>
					</form>";
						if($_SESSION['membership'] == 'Admin'){
						echo "<button class='btn btn-warning ml-auto'>Special Admin Button</button>";
						}
					}
					?>
				</div>
			</nav>
			<script>
				//bootstrap wasn't working, so I had to do toggle manually
				var navdiv = document.getElementById("nav-div");
				var navToggle = document.getElementById("navbar-toggler");
				navToggle.addEventListener("click", _=> {
					navdiv.classList.toggle("show");
				});
			</script>
		</header>
<?php
				include 'components/Input.php';
				include 'components/Select.php';
				include 'components/Radio.php';
				include 'components/CheckBox.php';
				include 'components/TextArea.php';
				include 'components/noErrors.php';	
