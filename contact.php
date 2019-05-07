<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<section class="mb-4">
    <!--Section heading-->
    <h3 class="text-center text-info"><br><br><br>Contact Us</h3>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.</p>
</section>


<?php
$contactForm = new Form('contact-form', 'mail.php', 'POST');

$contactName = new Input('contact-name', 'Enter your name:', 'text');

$contactEmail = new Input('contact-email', 'Enter your email', 'email');
$contactEmail->setValidator('Validator::validateEmail');



 $contactSubject = new Input('contact-subject', 'Enter your Subject', 'text'); 




$contactYourMessage = new Input('contact-yourmessage', 'Enter your Message', 'text');


/*function validateEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}*/

//$contactEmail->setValidator('validateEmail');




$contactSubmit = new Button('contact-submit', 'submit');

$contactSubmit->setClasslist('btn btn-info');


$contactForm->addFields($contactName, $contactEmail, $contactSubject, $contactYourMessage);
$contactForm->addButtons($contactSubmit);


$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $contactForm->setData();
  $contactForm->validate();

  if(!$contactForm->hasErrors()){
    $success = true;
    echo "<h4 class = 'text-success'>Success!</h4>";
  }

  //echo $contactName->getData();

}

if(!$success)
{
	?>
	<section class="container text-center">
 <?php $contactForm->render(); ?>
 <section>
  
  <?php
}

?>






 
<br><br><br><br>
<div class="videoWrapper">
    <br><br><br><br>
    <iframe width="820" height="476" src="https://maps.google.com/maps?q=perfect%20form%20fitness&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
  </div><br><br><br><br>

<!--

<section class="mb-4">
    
    <h3 class="text-center text-info"><br><br><br>Contact Us</h3>
   
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.</p>


	<div class="container">
		<div id="login-row" class="row justify-content-center align-items-center">
			<form id="contact-form" name="contact-form" action="mail.php" method="POST">

				
				<div class="row">
				
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="name" name="name" class="form-control">
							<label for="name" class="text-info">Your name</label>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="email" name="email" class="form-control">
							<label for="email" class="text-info">Your email</label>
						</div>
					</div>
				
				</div>
			
				<div class="row">
					<div class="col-md-12">
						<div class="md-form mb-0">
							<input type="text" id="subject" name="subject" class="form-control">
							<label for="subject" class="text-info">Subject</label>
						</div>
					</div>
				</div>
				
				<div class="row">
				
					<div class="col-md-12">
						<div class="form-group">
							<textarea id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
							<label for="message" class="text-info">Your message</label>
						</div>
						<div class="text-center text-md-center">
							<a class="btn btn-info btn-lg text-white" onclick="document.getElementById('contact-form').submit();">send</a>
						</div>
						<div class="status"></div>
					</div>
				
				</div>
				
			</form>
		</div>

	</div>
	
	<div class="h1-responsive font-weight-bold text-center my-4">
		<ul class="list-unstyled mb-0">
			<li><i class="text-center"></i>
				<p>Shop 1/13-17 Kennedy Cres, Bonnet Bay NSW 2226, Australia</p>
			</li>
			<li><i class="text-center"></i>
				<p>+ 01 435 242 23</p>
			</li>
			<li><i class="text-center"></i>
				<p>contact@perfectformfitness.com</p>
			</li>
		</ul>
	</div>
	

  <div class="embed-responsive-item col-md-4 mx-auto text-center">
    <br><br><br><br>
    <iframe width="620" height="476" src="https://maps.google.com/maps?q=perfect%20form%20fitness&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
  </div>

</section>

-->


<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>

<!--<script>
var contactSubmit = document.getElementById("contact-submit");	

contactSubmit.onclick = 

contactSubmit.addEventListenter("click", function()
{
	
});
	
</script> -->
