<?php 
include_once 'header.php';

$feature1 = new Feature('feature1', 'Yoga', 'things about yoga', 'images/yoga/yoga.jpg', 'yoga.php');
$feature1->render();
$features = Feature::getFeatured();
foreach($features as $feature){
	$feature->render();
}

include 'testimonial.php';
include_once 'footer.php';
?>
