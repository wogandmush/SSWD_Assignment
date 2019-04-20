<?php
include 'header.php';
if(!$isAdmin){
	header("Location: $root/index.php");
	exit();
}

echo "<section id='feature-manage'>";
$stage = new Input('stage', '', 'hidden');
$action = new Input('action', '', 'hidden');
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
	$createNew = new Button("action", "create-new", "Create New");
	$editExisting = new Button('action', 'edit-existing', 'Edit Existing');
	$changeFeatured = new Button('action', 'change-featured', 'Change Featured');
	$stage->setData("start");

	$actionForm = new Form('action-form', 'feature_manage.php', 'POST');
	$actionForm->addFields($stage, $action);
	$actionForm->addButtons($createNew, $editExisting, $changeFeatured);
	echo "<h2 class='text-default'>Manage Features:</h2>";
	$actionForm->render();
}
else{
	if(!isset($_POST['stage']))
		$stage->setData("start");
	else $stage->setData($_POST['stage']);
	if(!isset($_POST['action'])){
		header("refresh: 2");
		exit();
	}
	$action->setData($_POST['action']);

	switch($action->getData()){
		case 'create-new':
			switch($stage->getData()){
				case "start":
					$contentForm = new Form("feature-content", "feature_manage.php");
					$contentForm->setData();
					$title = new Input('title', 'Choose title of feature');
					$title->setRequired(true);
					$detail = new TextArea('detail', 'Enter text content of your feature');
					$detail->setRequired(true);
					$stage->setData("choose-image");
					$contentForm->forwardPOST();
					$contentForm->addFields($stage, $action, $title, $detail);
					$submitContent = new Button('next');
					$contentForm->addButtons($submitContent);
					$contentForm->render();
					break;
				case 'choose-image':
					$imageForm = new Form("image-form", 'feature_manage.php');
					$imageForm->forwardPOST();
					$category = new Select('category', 'Choose image category');
					$categories = IOHelper::getDirectories("./images");
					$category->setOptions($categories);
					$category->render();
					$featureImg = new Input('feature-img', '', 'hidden');
					$featureImg->setRequired(true);
					$stage->setData("submit");
					$nextButton = new Button('next');
					$imageForm->addFields($stage, $action, $featureImg);
					$imageForm->addButton($nextButton);
					$imageForm->render();
?>
<div id='gallery'>
</div>
<script>
var gallery = document.querySelector('#gallery');
var category = document.querySelector('#category');
var featureImage = document.querySelector('#feature-img');
var images = [];
category.addEventListener("change", getImages);
	function getImages(e){
		var inputs = document.querySelectorAll('input');
		inputs.forEach(x => console.log(x.value));
		if(images.length > 0){
			for(let i=images.length-1; i>=0;i--){
			gallery.removeChild(images[i]);
			}
		}
		let imgCategory = e.target.value;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "image_get.php?category="+imgCategory);
		xhr.onload = function(){
			var json = xhr.responseText;
			res = JSON.parse(json);
			images = res.map((src, i) => {
				var img = document.createElement("img");
				img.className = "gallery-img";
				img.src = src;
				return img;
			});
			images.forEach(img => gallery.appendChild(img));
			$(".gallery-img").bind('click', function(){
				$(".gallery-img").removeClass('selected');
				$(this).toggleClass('selected');
				featureImage.value = this.src;
			});
		}
		xhr.send();
	};
	getImages({target: category});
</script>
<?php
					break;
				case 'submit':
					$title  = $_POST['title'];
					$detail = $_POST['detail'];
					$img_url = $_POST['feature-img'];
					$feature = new Feature("", $title, $detail, $img_url);
					$feature->render();
					$stage->setData('complete');
					$submitForm = new Form('feature-submit', 'feature_manage.php');
					$submitForm->forwardPOST();
					$submitForm->addFields($stage);
					$submitButton = new Button('submit', 'submit');
					$submitForm->addButton($submitButton);
					$submitForm->render();
					break;
				case 'complete':
					$title = $_POST['title'];
					$detail = $_POST['detail'];
					$img_url = $_POST['feature-img'];
					$feature = new Feature("", $title, $detail, $img_url);
					if($feature->create()){
						header("Refresh: 2; url='feature_manage.php'");
						exit();
					}
					else{
						echo "Something went poorly";
					}
					break;
				default: 
					break;
			}
			break;
		case 'edit-existing':
			echo "<h4 class='text-danger'>I mean I must have said this before, since I say it now</h4>";
			break;
		case 'change-featured':
			switch($stage->getData()){
			case 'start':
				$features = Feature::getFeatured();
				echo "<form action='feature_manage.php' method='POST'>";
				Form::renderForwardPOST();
				foreach($features as $index=>$feature){
					$feature->render();
					$selectButton = new Button('feature-number', ++$index, 'change');
					$selectButton->render();
				}
				$stage->setData('choose-feature');
				$stage->render();
				echo "</form>";
				break;
			case 'choose-feature':
				$features = Feature::getNonFeatured();
				echo "<form action='feature_manage.php' method='POST'>";
				Form::renderForwardPost();
				$stage->setData("complete");
				$stage->render();
				foreach($features as $feature){
					$feature->render();
					$featureButton = new Button('feature-id', $feature->getId(), 'feature');
					$featureButton->render();
				}
				echo "</form>";
				break;
			case 'complete';
				$featureId = $_POST['feature-id'];
				$featureNumber = $_POST['feature-number'];
				if(Feature::setFeatured($featureId, $featureNumber)){
					echo "<h4 class='text-success'>Successully updated list of features</h4>";
				}
				else{
					echo "<h4 class='text-warning'>Something went wrong</h4>";
				}
				header("Refresh: 2;url='index.php'");
				break;
			default:
				echo "<h4 class='text-error'>Something went wrong</h4>";
				header("Refresh:2; url=feature_manage.php");
				exit();
			}
			break;
		default:
			break;
	}
}
echo "</section>";
