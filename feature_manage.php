<?php
include 'header.php';
if(!$isAdmin){
	header("Location: $root/index.php");
	exit();
}

echo "<section id='feature-manage'>";
var_dump($_POST);
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
					sort($categories);
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
<script src='scripts/createImageGallery.js'></script>
<script>
var gallery = document.querySelector('#gallery');
var imageCategories = document.querySelector('#category');
var imageInput = document.querySelector('#feature-img');
var imageForm = document.querySelector("#image-form");
// prevent form from submitting if image has not been chosen
imageForm.addEventListener("submit", e => {
	if(imageInput.value === ""){
		e.preventDefault();
		alert("please choose an image");
	}
});
createImageGallery(gallery, imageCategories, imageInput);
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
			switch($stage->getData()){
				case "start":

					echo "<form action='feature_manage.php' method='POST'>";
					Form::renderForwardPOST();
					$stage->setData('choose-action');
					$stage->render();
					$features = Feature::read();
					foreach($features as $feature){
						$feature->render();
						$editButton = new Button("feature-id", $feature->getId(), "Edit");
						$editButton->render();
					}
					echo "</form>";
					break;
				case 'choose-action':
					$condition = "WHERE id =  ${_POST['feature-id']}";
					$toEdit = Feature::read($condition, 1)[0];
					$toEdit->render();
					$editForm = new Form('edit-form');
					$editTitle = new Button('edit-action', 'title', 'Edit Title');
					$editDetail = new Button('edit-action', 'detail', 'Edit Detail');
					$editImage = new Button('edit-action', 'image', 'Change Picture');
					$editLink = new Button('edit-action', 'link', 'Change Link');
					$stage->setData('edit-content');
					$editForm->forwardPOST();
					$editForm->addField($stage);			
					$editForm->addButtons($editTitle, $editDetail, $editImage, $editLink);
					$editForm->render();
					break;
				case 'edit-content':
					$editAction = $_POST['edit-action'];
					$featureId = $_POST['feature-id'];
					$featureToEdit = Feature::read("WHERE id = $featureId")[0];
					switch($editAction){
						case 'image':
							if(isset($_POST['new-image'])){
								$imgUrl = $_POST['new-image'];
								if($featureToEdit->update('img_url', $imgUrl)){
									$featureToEdit->setImageURL($imgUrl);
									$featureToEdit->render();
								}
								else {
									echo "<h4 class='text-warning'>Could not update feature</h4>";
								}
								exit();
							}
							$featureToEdit->render();
							echo "<h4 class='text-default'>Choose a new image</h4>";
							$editImageForm = new Form('edit-feature-image', 'feature_manage.php');
							$editImageForm->forwardPOST();
							$categorySelect = new Select('edit-image-categories', "Choose image category: ");
							$categories = IOHelper::getDirectories("$fsRoot/images/");
							$categorySelect->setOptions($categories);
							$newImage = new Input('new-image', '', 'hidden');

							$stage->setData('submit');
							$editImageForm->addFields($categorySelect, $newImage);
							$submitButton = new Button('submit');
							$editImageForm->addButton($submitButton);
							$editImageForm->render();
?>
<div id='gallery'>
</div>
<script src='scripts/createImageGallery.js'></script>
<script>
var gallery = document.getElementById('gallery');
var categorySelect = document.getElementById('edit-image-categories');
var newImage = document.getElementById('new-image');
var featurePreview = document.querySelector(".feature img");
function updateFeatureImage(src){
	featurePreview.src = src;
}
createImageGallery(gallery, categorySelect, newImage, updateFeatureImage);
</script>
<?php
							break;
						case 'title':
							if(isset($_POST['new-title'])){
								$newTitle = $_POST['new-title'];
								if($featureToEdit->update('feature_title', $newTitle)){
									$featureToEdit->setTitle($newTitle);
									$featureToEdit->render();
									exit();
								}
							}
							$featureToEdit->render();
							$editTitleForm = new Form('edit-feature-title');
							$editTitleForm->forwardPOST();
							$newTitleInput = new Input('new-title', 'Enter new title');
							$newTitleInput->setRequired(true);
							$editTitleForm->addFields($newTitleInput);
							$editTitleSubmit = new Button('submit');
							$editTitleForm->addButton($editTitleSubmit);
							$editTitleForm->render();
?>
<script>

var featureTitle = document.querySelector(".feature h1");
console.log(featureTitle);
var newTitle = document.querySelector('#new-title');
newTitle.addEventListener("keyup", e => {
	featureTitle.textContent = e.target.value;
});


</script>

<?php

							break;
						case 'detail':
							if(isset($_POST['new-detail'])){
								$newDetail = $_POST['new-detail'];
								if($featureToEdit->update('detail', $newDetail)){
									$featureToEdit->setDetail($newDetail);
									$featureToEdit->render();
									exit();
								}
							}
							$featureToEdit->render();
							$editDetailForm = new Form('edit-feature-title');
							$editDetailForm->forwardPOST();
							$newDetailTextArea = new TextArea('new-detail', 'Edit detail');
							$newDetailTextArea->setData($featureToEdit->getDetail());
							$editDetailForm->addFields($newDetailTextArea);
							$submitTitle = new Button('submit');
							$editDetailForm->addButton($submitTitle);
							$editDetailForm->render();

?>
<script>
var featureDetail = document.querySelector(".feature p");
var newDetail = document.querySelector("#new-detail");
newDetail.addEventListener("keyup", e =>{
	featureDetail.textContent = newDetail.value;
});

</script>
<?php
							break;
						case 'link':
							if(isset($_POST['new-link'])){
								$newLink = $_POST['new-link'];
								if($featureToEdit->update('link', $newLink)){
									echo "<h4 class='text-success'>Link updated successfully</h4>";
									header("refresh: 3s;url='feature-manage.php'");
									exit();
								}
							}
							$featureToEdit->render();
							$editLinkForm = new Form('feature-edit-link');
							$editLinkForm->forwardPOST();
							$newLinkInput = new Input('new-link', 'Enter new link: ');
							$editLinkForm->addFields($newLinkInput);
							$submitLink = new Button('edit-link-submit', 'submit');
							$editLinkForm->addButton($submitLink);
							$editLinkForm->render();
?>

<script>
var linkForm = document.querySelector("#feature-edit-link");
var linkInput = document.querySelector("#new-link");
linkForm.addEventListener("submit", e => {
	e.preventDefault();
	var xhr = new XMLHttpRequest();
	// prefix https://cors.io/? to prevent cors cross-origin-access error
	var linkUrl = 'https://cors.io/?'+linkInput.value;
	xhr.open("GET", linkUrl);
	console.log(xhr);
	xhr.onload = function(){
		console.log(xhr);
		console.log(linkForm);
		// if link is valid, submit the form
		if(xhr.status === 200)
			linkForm.submit();
		else
			alert("Link is not valid");
	}
	xhr.send();
});

</script>
<?php
							break;
						default:
							echo "<h4 class='text-warning'>Something went wrong</h4>";
							break;
					}
					break;
				default:
					echo "<h4 class='text-danger'>You have failed</h4>";
					break;
			}
			break;
		case 'change-featured':
			switch($stage->getData()){
			case 'start':
				$features = Feature::getFeatured();
				echo "<form action='feature_manage.php' method='POST'>";
				Form::renderForwardPOST();
				foreach($features as $index=> $feature){
					$feature->render();
					$selectButton = new Button('feature-number', $index+1, 'change');
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
