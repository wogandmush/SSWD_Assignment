<?php 
include 'header.php'; 


$testimonials = Testimonial::loadApproved();

	// div to contain all testimonials
?>
	<main id='testimonials'>
	   	<div class='container' id='testimonial-container'>
<?php
if($testimonials){
	foreach($testimonials as $testimonial){
		$testimonial->render();
	}
}
if(isset($_SESSION['membership'])){
	echo "<p id='testimonial-share'>Want to share your experiences? <a href='testimonial_add.php'>Add a testimonial</a></p>";
}
?>
		</div>
	</main>
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

<?php
include 'footer.php';
?>
