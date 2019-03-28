<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened
?>
<section class="mb-4">
    <!--Section heading-->
    <h3 class="text-center text-info"><br><br><br>Contact Us</h3>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.</p>

	<!--Grid column-->
	<div class="container">
		<div id="login-row" class="row justify-content-center align-items-center">
			<form id="contact-form" name="contact-form" action="mail.php" method="POST">

				<!--Grid row-->
				<div class="row">
					<!--Grid column-->
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="name" name="name" class="form-control">
							<label for="name" class="text-info">Your name</label>
						</div>
					</div>
					<!--Grid column-->

					<!--Grid column-->
					<div class="col-md-6">
						<div class="md-form mb-0">
							<input type="text" id="email" name="email" class="form-control">
							<label for="email" class="text-info">Your email</label>
						</div>
					</div>
					<!--Grid column-->
				</div>
				<!--Grid row-->

				<!--Grid row-->
				<div class="row">
					<div class="col-md-12">
						<div class="md-form mb-0">
							<input type="text" id="subject" name="subject" class="form-control">
							<label for="subject" class="text-info">Subject</label>
						</div>
					</div>
				</div>
				<!--Grid row-->

				<!--Grid row-->
				<div class="row">
					<!--Grid column-->
					<div class="col-md-12">
						<div class="form-group">
							<textarea id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
							<label for="message" class="text-info">Your message</label>
						</div>
						<div class="text-center text-md-left">
							<a class="btn btn-info btn-md" onclick="document.getElementById('contact-form').submit();">Send</a>
						</div>
						<div class="status"></div>
					</div>
					<!--Grid column-->
					<!--<div class="text-center text-md-left">
											<input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
										</div> -->
				</div>
				<!--Grid row-->
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
