<?php
include '../header.php';
$features = Feature::getFeatured();

foreach($features as $feature){
	$feature->render();
}

include '../footer.php';
