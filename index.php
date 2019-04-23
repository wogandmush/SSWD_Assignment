<?php 
include_once 'header.php';

$features = Feature::getFeatured();
foreach($features as $feature){
	$feature->render();
}

include 'testimonial.php';
include_once 'footer.php';
?>
