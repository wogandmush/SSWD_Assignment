<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// primary validate function
	
	function validate($str) {
		return trim(htmlspecialchars($str));
	}    
    
	if (empty($_POST['name'])) {
		$nameError = 'Name should be filled';
	} else {
		$name = validate($_POST['name']);
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
			$nameError = 'Name can only contain letters, numbers and white spaces';
		}
	}
    
    if (empty($_POST['lname'])) {
		$lnameError = 'Last Name should be filled';
	} else {
		$lname = validate($_POST['lname']);
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $lname)) {
			$lnameError = 'Name can only contain letters, numbers and white spaces';
		}
	}

    if (empty($_POST['dateofbirth'])) {
		$dateofbirthError = 'date of birth should be filled';
	} else {
		$dateofbirth = validate($_POST['dateofbirth']);
            
            $temp_date = $dateofbirth;
            $date_arr  = explode('-', $temp_date);
            if (checkdate($date_arr[0], $date_arr[1], $date_arr[2])) {
                $dateofbirthError = 'date of birth must be written in the correct format';
            }         	
	}

    if (empty($_POST['gender'])) {
		$genderError = 'Please enter your gender';
	} else {
		$gender = $_POST['gender'];
	}

    if (empty($_POST['phoneno'])) {
		$phonenoError = 'phone number should be filled and match the following format eg 0852534837';
	} else {
		$phoneno = validate($_POST['phoneno']);
		if (!preg_match('/^[0-9]{7,}$/', $phoneno)) {
			$phonenoError = 'phone number should only contain numbers and match the following format eg 0852534837';
		}
	}
        
	if (empty($_POST['email'])) {
		$emailError = 'Please enter your email';
	} else {
		$email = validate($_POST['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailError = 'Invalid Email';
		}
	}
     
      if (empty($_POST['address'])) {
		$addressError = 'address cannot be empty';
	} else {
		$address = validate($_POST['address']);
		if (strlen($address) < 10) {
			$addressError = 'Address should be longer than 10 characters';
		}
	}
    
	if (empty($_POST['password'])) {
		$passwordError = 'Password cannot be empty';
	} else {
		$password = validate($_POST['password']);
		if (strlen($password) < 6) {
			$passwordError = 'Password should be longer than 6 characters';
		}
	}
	
	if (empty($_POST['confirmpassword'])) {
		$passwordError = 'Please Confirm Password';
	} else {
		$confirm_password = validate($_POST['confirmpassword']);
		if (strlen($confirm_password) < 6) {
			$confirm_passwordError = 'Password should be longer than 6 characters';
		}
		if ($password != $confirm_password)
		{
		    $passwordError = 'Passwords should match';
	        //echo $password . " " . $confirm_password;
		}
	}
    
    if (empty($_POST['membership'])) {
		$membershipError = 'Please enter your membership';
	} else {
		$membership = $_POST['membership'];
	}
    
	$remember = !empty($_POST['remember']) ? filter_var($_POST['remember'], FILTER_VALIDATE_BOOLEAN) : ""; 

	if (empty($nameError) && empty($emailError) && empty($genderError) && empty($passwordError) && empty($confirm_passwordError)&& empty($lnameError) && empty($dateofbirthError) && empty($phonenoError) && empty($addressError) && empty($membershipError)) 
    {
		// completed the form
		?>
            <div class="text-center">
                <h1><strong><br>You have filled the form successfully!</strong></h1>         
                <h5><strong>Your first name is </strong></h5> <?php echo $name ?><br>  
                <h5><strong>Your second name is </strong></h5> <?php echo $lname ?><br>   
                <h5><strong>Your birthdate is </strong></h5> <?php echo $dateofbirth ?><br> 
                <h5><strong>Your Gender is </strong></h5> <?php echo $gender ?><br>  
                <h5><strong>Your phone number is </strong></h5> <?php echo $phoneno ?><br>     
                <h5><strong>Your email is </strong></h5> <?php echo $email ?><br>       
                <h5><strong>Your Address is </strong></h5> <?php echo $address ?><br>
                <h5><strong>Your password is </strong></h5> <?php echo $password ?><br>
                <h5><strong>Your membership is </strong></h5> <?php echo $membership ?><br>
                
          </div>                       
        </body>

        <?php
		// mysqli_real_escape_string needed here
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$conn = DBConnect::getConnection();
        $sql = "INSERT INTO member (first_name, last_name, date_of_birth, gender, home_tel, email, address, membership, password) VALUES ('$name', '$lname', '$dateofbirth', '$gender', '$phoneno', '$email', '$address', '$membership', '$hash')";
        if(mysqli_query($conn, $sql)){
            echo "<p>New row added successfully!</p>";  
        }else{
        echo "ERROR: Unable to execute $sql" . mysqli_error($conn);   
        }     
            
		mysqli_close($conn);
		exit(); // terminates the script
	} 
}
?>
	
    <div class="container"> 
    <h2><br>Member Registration</h2><br><br>
<form class="form-horizontal" action="" method="post">
    <!--
	<div class="col-xs-1" align="left">
	<button type="button" onclick="location.href='https://knuth.griffith.ie/~s2994354/lab5/add_search.php'" class="btn btn-warning">Go Back</button>
	
	<button type="button" onclick="location.href='https://knuth.griffith.ie/~s2994354/lab5/search.php'" class="btn btn-info">Search</button><br><br>
	</div>
	-->
	
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="name">First Name *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Enter First Name" value="<?php if (isset($name)) echo $name ?>" pattern="^[( )a-zA-Z]+$"/>
        </div>
        <span class="error"><?php if (isset($nameError)) echo $nameError ?></span><br>
    </div>  
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="lname">Last Name *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php if (isset($lname)) echo $lname ?>" pattern="^[( )a-zA-Z]+$"/>
        </div>
        <span class="error"><?php if (isset($lnameError)) echo $lnameError ?></span><br>
    </div>  
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="name">Email *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" placeholder="Enter Email eg johnsmith@gmail.com" value="<?php if (isset($email)) echo $email ?>" pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$"/>
        </div>
        <span class="error"><?php if (isset($emailError)) echo $emailError ?></span><br>
    </div>    
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="password">Password *</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php if (isset($password)) echo $password ?>"/>
        </div>
        <span class="error"><?php if (isset($passwordError)) echo $passwordError ?></span><br>
    </div>  
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="confirmpassword">Confirm Password *</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm password" value="<?php if (isset($confirm_password)) echo $confirm_password ?>"/>
        </div>
        <span class="error"><?php if (isset($confirm_passwordError)) echo $confirm_passwordError ?></span><br>
    </div>  
    
    
     <div class="form-group"> 
        <label class="control-label col-sm-2" for="phoneno">Phone Number *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="phoneno" placeholder="Enter phone number eg 0852534837" value="<?php if (isset($phoneno)) echo $phoneno ?>"/>
        </div>
        <span class="error"><?php if (isset($phonenoError)) echo $phonenoError ?></span><br>
    </div>  
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="address">Address *</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="address" placeholder="Enter address" value="<?php if (isset($address)) echo $address ?>"/>
        </div>
        <span class="error"><?php if (isset($addressError)) echo $addressError ?></span><br>
    </div>  
    
    <div class="form-group"> 
        <label class="control-label col-sm-2" for="dateofbirth">Date of Birth *</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="dateofbirth" placeholder="Enter date of birth" value="<?php if (isset($dateofbirth)) echo $dateofbirth; else echo '1990-01-01'; ?>"/>
        </div>
        <span class="error"><?php if (isset($dateofbirthError)) echo $dateofbirthError ?></span><br>
    </div>  
    
    
    <div class="wow fadeInDown form-group" data-wow-delay="0.9s"> 
        <label class="control-label col-sm-2" for="select">Membership *</label>
        <select class="browser-default custom-select col-sm-10" id="select" name="membership">
        <option value="" disabled="" selected="" >Choose your membership option </option>  
        <option value="Student Monthly" >Student Monthly (€29.50 monthly)</option>
        <option value="Adult Monthly">Adult Monthly (€39.50 monthly)</option>
        <option value="Adult Yearly">Adult Yearly (€379.50 yearly)</option>
     </select>
        <br><span class="error"><?php if (isset($membershipError)) echo $membershipError ?></span><br>
    </div><br><br>
    
    <!--
    <div class="wow fadeInDown form-group" data-wow-delay="0.9s"> 
        <label class="control-label col-sm-2" for="select">Membership *</label>
        <select class="browser-default custom-select col-sm-10" id="select" name="membership">
        <option value="" disabled="" selected="" >Choose your membership option </option>  
        <option value="Student Monthly" >Student Monthly (€29.50 monthly)</option>
        <option value="Adult Monthly">Adult Monthly (€39.50 monthly)</option>
        <option value="Adult Yearly">Adult Yearly (€379.50 yearly)</option>
     </select>
        <br><span class="error"><?php //if (isset($membershipError)) echo $membershipError ?></span><br>
    </div><br><br>-->
        
    
	<!--Password: 
	<input type="password" name="password"> 
	<span class="error"><?php// if (isset($passwordError)) echo $passwordError ?></span><br><br> -->
    
                   <!-- Default inline 1-->
    <p>Which Classes would you like to sign up to</p>

    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="defaultInline1">
      <label class="custom-control-label" for="defaultInline1">Strength</label>
    </div> <br><br>

    <!-- Default inline 2-->
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="defaultInline2">
      <label class="custom-control-label" for="defaultInline2">Yoga</label>
    </div> <br><br>

    <!-- Default inline 3-->
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="defaultInline3">
      <label class="custom-control-label" for="defaultInline3">Cardio</label>
    </div> <br><br><br><br>

      
        
    <div class="form-group">   
        Gender: 
		Male
		<input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender === "male") echo "checked" ?>> 
		Female
		<input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender === "female") echo "checked" ?>><br>
        <span class="error"><?php if (isset($genderError)) echo $genderError ?></span> <br>   
     </div> <br><br> 
        
	<!--Remember Me: 
	<input type="checkbox" name="remember"> -->
	<div class = 'text-center'>
    <button class="btn btn-outline-success" type="submit">Submit</button><br><br><br><br><br>
     </div>
        
		</form>
	 </div>
<?php
include 'footer.php';
?>
