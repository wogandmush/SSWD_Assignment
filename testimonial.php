<?php 

#
# This page is included in index.php, as well as in the individual class pages
#
# It loads a batch of admin-approved user-submitted testimonials from the database, and cycles through them at random, using javascript/JQuery
#
# if a user is logged in as member, a link is also provided, which members can follow to add their own new testimomials
#

include_once 'header.php'; 

// load default testimonials if not loaded before include
if(!isset($testimonials))
	$testimonials = Testimonial::loadApproved();

	// div to contain all testimonials
?>
	<section id='testimonial'>
	   	<div class='container' id='testimonial-container'>
<?php
if($testimonials){
	foreach($testimonials as $testimonial){
		$testimonial->render();
	}
}
if($isMember){
	echo "<p id='testimonial-share'>Want to share your experiences? <a href='testimonial_add.php'>Add a testimonial</a></p>";
}
?>
		</div>
	</section>
<script>
var testimonials = document.getElementsByClassName('testimonial');
$(testimonials).hide();
var shownIndex = Math.floor(Math.random() * testimonials.length);
var oldIndex;
var shown = testimonials[shownIndex];
var fadeTime = 800;
var delayTime = 4000;
(function changeShown(){
	// ensure that same message is not displayed twice in succession
	oldIndex = shownIndex; 
	if(testimonials.length > 1){
	while(oldIndex === shownIndex) 
		shownIndex = Math.floor(Math.random() * testimonials.length);
	}
	shown = testimonials[shownIndex];
	$(shown)
		.fadeIn(fadeTime)
		.delay(delayTime)
		.fadeOut(fadeTime, changeShown);
})();
</script>

