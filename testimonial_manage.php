<?php

include './header.php';

$testimonials = Testimonial::loadUnapproved();
?>
	<main id='testimonials'>
	   	<div class='container' id='testimonial-container'>
<?php
if($testimonials){
	foreach($testimonials as $testimonial){
		$testimonial->render();
	}
}
?>
		</div>
	</main>
<script>
$('.testimonial').show()</script>
<?php
include './footer.php';
