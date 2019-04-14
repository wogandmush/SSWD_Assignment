<?php 

include 'header.php';

if(!$isAdmin){
	header("Location: $root/index.php");
	exit();
}

echo mime_content_type(getcwd() . "/images/yoga/yoga.jpg");
echo mime_content_type(getcwd() . "/images/..");

$features = Feature::read();

$imgCategory = new Select('category', "Select category");
$directories = IOHelper::getFiles(getcwd() ."/images");
$imgCategory->setOptions($directories);
$imgCategory->render();

$images = IOHelper::getImages(getcwd()."/images/pilates");
foreach($images as $image){
	echo "<img src='$root/images/pilates/$image'></img>";
}

$featureForm = new Form('feature-create', 'feature_manage.php', 'POST');
$featureForm->setClassList("mx-auto");
$featureTitle = new Input('title', 'Choose feature title');
$featureDetail = new TextArea('detail', 'Write body of feature:');
$featureForm->addFields($featureTitle, $featureDetail);
$featureSubmit = new Button('feature_submit', 'Submit');
$featureForm->addButtons($featureSubmit);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$featureForm->setData();
	$featureForm->validate();
	if(isset($_POST['feature_submit']) && !$featureForm->hasErrors()){
		echo "<h4>Success</h4>";
		var_dump($_POST);
	}
}

$featureForm->render();
include 'footer.php';
