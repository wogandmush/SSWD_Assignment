<?php
include './header.php';

echo "<section id='image-manage'>";
if(!isset($_FILES['img-upload'])){
$imgForm = new Form('img-form', 'image_manage.php', 'POST');
$imgUpload = new Input('img-upload', 'Upload an new image: ', 'file');

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
<canvas id="img-crop-canvas"></canvas>

	<script src='js/image_cropper.js'>
	</script>
<?php
	$selectBtn = new Button('select-btn', 'Crop Selection');
	$selectBtn->render();
}
echo "</section>";
include './footer.php';
