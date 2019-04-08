<?php

session_start();

###for testing###
#$_SESSION['is_admin'] = 1;
#$_SESSION['first_name'] = 'Dan';
#$_SESSION['user_no'] = 1;
ini_set('display_errors', 1);

include 'components/Input.php';
include 'components/Select.php';
include 'components/Radio.php';
include 'components/CheckBox.php';
include 'components/TextArea.php';
include 'components/noErrors.php';	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>=Fitness Club Website</title>
		<link rel="stylesheet" href="css/reset.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<!-- commented out until needed -->
			<!--
		<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/materia/bootstrap.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
-->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href='index.php'>Home</a>
				<button class="navbar-toggler" type="button" id="navbar-toggler"> 
					<span class="navbar-toggler-icon"></span>
				</button>
				<!--
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-div" aria-controls="nav-div" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
						<span class="navbar-toggler-icon"></span>
					</button>
					<p> </p>
				-->
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
						<li class="nav-item">
							<a class="nav-link" href="register.php">Register</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.php">Contact Us</a>
						</li>
					</ul>
					<?php if(isset($_SESSION['user_no'])){ ?>
					<button class="btn btn-success ml-auto">logged in as <?php echo $_SESSION['first_name'] ?></button>
					<form action="logout.php">
						<button class="btn btn-warning ml-auto">Logout</button>
					</form>
					<?php if($_SESSION['membership'] == 'Admin')
					{ ?>
					<button class="btn btn-warning ml-auto">Special Admin Button</button>
					<?php } ?>
					<?php } ?>
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
