<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened

$name = new Input('name', 'Your name');
$name->setRequired(true);
$email = new Input('email', 'Your email', 'email');
$email->setRequired(true);
$subject= new Input('subject', 'Subject');
$subject->setRequired(true);
$message = new TextArea('message', 'Your message');
$message->setAttributes(array(
	'rows'=>2,
	'required',
));

?>
<section class="mb-4">
    <!--Section heading-->
    <h3 style="margin-top: 2em"class="text-center text-info">Contact Us</h3>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.</p>

	<!--Grid column-->
	<div class="container">
		<div id="login-row" class="col-md-6 mx-auto justify-content-center align-items-center">
			<form id="contact-form" name="contact-form" action="mail.php" method="POST">

<?php
	$name->render();
	$email->render();
	$subject->render();
	$message->render();
?>

					<div class="text-center text-md-left">
						<a class="btn btn-info btn-md" onclick="document.getElementById('contact-form').submit();">Send</a>
					</div>
					<div class="status"></div>
				</div>
				<!--Grid column-->
				<!--<div class="text-center text-md-left">
										<input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
									</div> -->
			</form>

		</div>
	</div>
	<!--Grid column-->
	<div class="h1-responsive font-weight-bold text-center my-4">
		<ul class="list-unstyled mb-0">
			<li><i class="text-center"></i>
				<p>Dublin, Frankdown Lane, Rathmines</p>
			</li>
			<li><i class="text-center"></i>
				<p>+ 01 435 242 23</p>
			</li>
			<li><i class="text-center"></i>
				<p>contact@fitness.com</p>
			</li>
		</ul>
	</div>
	<!--Grid column-->
</section>

<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
