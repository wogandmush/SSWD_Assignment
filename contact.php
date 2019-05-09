<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>

<section class="mb-4">
    <!--Section heading-->
    <h3 class="text-center text-info"><br><br><br>Contact Us</h3>
    <!--Section description-->
	<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.
<?php
if($isMember){
	echo "<br/><a href='$root/contact_manage.php'>Reply to a query</a>";
}
?>

</p>
</section>

<?php
$contactForm = new Form('contact-form', 'contact_mail.php', 'POST');
$contactName = new Input('contact-name', 'Enter your name:', 'text');
$contactName->setRequired(true);
$contactEmail = new Input('contact-email', 'Enter your email', 'email');
$contactEmail->setRequired(true);
//$contactEmail->setValidator('Validator::validateEmail');

$contactSubject = new Input('contact-subject', 'Enter your Subject', 'text'); 
$contactSubject->setRequired(true);

$contactMessage = new Input('contact-message', 'Enter your Message', 'text');
$contactMessage->setRequired(true);

$contactMobile = new Input('contact-mobile', 'Enter your mobile number');

$contactSubmit = new Button('contact-submit', 'submit');
$contactSubmit->setClasslist('btn btn-info');

$contactForm->addFields($contactName, $contactEmail, $contactSubject, $contactMessage, $contactMobile);
$contactForm->addButtons($contactSubmit);


$success = false;
/*
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
*/

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


<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
