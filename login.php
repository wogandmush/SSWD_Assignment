<?php
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
