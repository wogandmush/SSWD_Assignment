<?php
include 'header.php';
if(!$isAdmin){
	header("Location: $root/index.php");
	exit();
}

$stage = new Input('stage', '', 'hidden');
$action = new Input('action', '', 'hidden');
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
	$createNew = new Button("action", "create-new", "Create New");
	$editExisting = new Button('action', 'edit-existing', 'Edit Existing');
	$changeFeatured = new Button('action', 'change-featured', 'Change Featured');
	$stage->setData("1");

	$actionForm = new Form('action-form', 'feature_manage.php', 'POST');
	$actionForm->addFields($stage, $action);
	$actionForm->addButtons($createNew, $editExisting, $changeFeatured);
	$actionForm->render();
}
else{
	if(!isset($_POST['stage']))
		$stage->setData("1");
	else $stage->setData($_POST['stage']);
	if(!isset($_POST['action'])){
		var_dump($_POST);
		header("refresh: 2");
		exit();
	}
	$action->setData($_POST['action']);

	switch($action->getData()){
		case 'create-new':
			var_dump($_POST);
			switch($stage->getData()){
				case "1":

					$contentForm = new Form("feature-content", "feature_manage.php");
					$contentForm->forwardPOST();
					$title = new Input('title', 'Choose title of feature');
					$detail = new TextArea('detail', 'Enter text content of your feature');
					$stage->setData("2");
					$contentForm->addFields($stage, $action, $title, $detail);
					$submitContent = new Button('next');
					$contentForm->addButtons($submitContent);
					$contentForm->render();
					break;
				case '2':
					$category = new Select('category', 'Choose image category');
					$categories = IOHelper::getDirectories("./images");
					$category->setOptions($categories);
					$featureImg = new Input('feature-img', '', 'hidden');
					$stage->setData("3");
					$nextButton = new Button('next');
					$imageForm = new Form("image-form", 'feature_manage.php');
					$imageForm->forwardPOST();
					$imageForm->addFields($stage, $action, $category, $featureImg);
					$imageForm->addButton($nextButton);
					echo count($imageForm->getFields());
					$imageForm->render();
?>
<div id='gallery'>
</div>
<script>
var gallery = document.querySelector('#gallery');
var category = document.querySelector('#category');
var featureImage = document.querySelector('#feature-img');
var images = [];
category.addEventListener("change", e => {
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
});
</script>
<?php
					break;
				case '3':
					echo "Wow, you've made it this far!";
					$title  = $_POST['title'];
					$detail = $_POST['detail'];
					$img_url = $_POST['feature-img'];
					$feature = new Feature("", $title, $detail, $img_url);
					$feature->render();
					$stage->setData('4');
					$submitForm = new Form('feature-submit', 'feature_manage.php');
					$submitForm->forwardPOST();
					$submitForm->addFields($stage);
					$submitButton = new Button('submit', 'submit');
					$submitForm->addButton($submitButton);
					$submitForm->render();
					break;
				case '4':
					echo "<h4 class='text-error'>The Heart of Darkness</h4>";
					$title = $_POST['title'];
					$detail = $_POST['detail'];
					$img_url = $_POST['feature-img'];
					$feature = new Feature("", $title, $detail, $img_url);
					if($feature->create()){
						echo "<h4 class='text-success'>All is well</h4>";
						header("Refresh: 2; url='feature_manage.php'");
						exit();
					}
					else{
						echo "Something went poorly";
					}
					break;
				default: 
					echo $stage->getData();
					break;
			}
			break;
		case 'edit-existing':
			echo "<h4 class='text-danger'>I mean I must have said this before, since I say it now</h4>";
			break;
		default:
			var_dump($_POST);
			break;
	}
}
