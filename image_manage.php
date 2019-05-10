<?php
include './header.php';
if(!$isAdmin){
	header("Location: index.php");
	exit();
}

echo "<section id='image-manage'>";
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['upload'])){
	$uploadSrc = $_GET['path'];
	echo "<h4 class='text-success'>Succesfully uploaded image</h4>";
	echo "<img src='$uploadSrc' />";
}

if(!isset($_FILES['img-upload'])){
	$imgForm = new Form('img-form');
	$imgUpload = new Input('img-upload','Upload an new image: ','file');
	$imgForm->addFields($imgUpload);
	$imgForm->setClassList("mx-auto");
	$uploadBtn = new Button('upload');
	$imgForm->addButtons($uploadBtn);
	$imgForm->setEnctype("multipart/form-data");
	$imgForm->render();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	echo "<div id='image-crop'>";
	$category = new Select('img-category', 'Choose image category');
	$categories = IOHelper::getDirectories("$fsRoot/images");
	sort($categories);
	$categories['*create new*'] = 'create-new';
	$category->setOptions($categories);
	$category->render();
	$filename = new Input("file-name", "Choose name for image");
	$filename->render();
	$filepath = $fsRoot . "/images/.temp/".$_FILES['img-upload']['name'];
	move_uploaded_file($_FILES['img-upload']['tmp_name'], $filepath);
	echo "</div>";
	$temp_src = $_FILES['img-upload']['name'];
	echo "<script>var src='$root/images/.temp/$temp_src';</script>";
?>
<p class='text-info'>Click to move selection; hold shift and move mouse to scale :)</p>
<canvas id="img-crop-canvas"></canvas>
<script>
var category = document.querySelector("#img-category");
category.addEventListener("change", e => {
	if(e.target.value === 'create-new'){
		var newCat = prompt("Enter name for new category");
		if(!newCat)
			return;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", 'image_db.php');
		xhr.onload = function(){
			var json = xhr.responseText;
			var res = JSON.parse(json);
			if(res.success){
				newCat = res.new_category;
				var option = document.createElement("option");
				option.innerText = newCat;
				var next;
				var options = category.children;
				for(let i=0;i<options.length;i++){
					if(options[i].textContent > newCat){
						next = options[i];
						break;
					}
				}
				category.insertBefore(option, next);
				category.value = newCat;
			}
			else {
				alert("Sorry, something went wrong");
			}
		}
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send('new-category='+newCat);
	}
});

</script>
	<script src='scripts/image_cropper.js'>
	</script>
<?php
	$selectBtn = new Button('select-btn', 'Crop Selection');
	$selectBtn->render();
}
echo "</section>";
include './footer.php';
