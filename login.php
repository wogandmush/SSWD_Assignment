<?php 



include 'header.php';
require '../config/connect.php';


session_start();
   
$myusername = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn, $myusername);
      $mypassword = mysqli_real_escape_string($conn, $password); 
      
      $sql = "SELECT * FROM member WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     // $active = $row['active'];
      if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count !== 1){
    echo '<div class="alert alert-danger">Wrong Username or Password</div>';
        }
        else {
            //log the user in: Set session variables
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['email']=$row['email'];
            $_SESSION['password']=$row['password'];
            echo " You are Logged in as " . $myusername;
              }
   }

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username(enter email):</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>











<?php
include 'footer.php';
?>
