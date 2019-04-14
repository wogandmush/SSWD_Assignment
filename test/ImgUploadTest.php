<?php
include '../header.php';

$imgForm = new Form('img-form', 'ImgUploadTest.php', 'POST');
$imgUpload = new Input('img-upload', 'Upload an image: ', 'file');
$imgForm->addFields($imgUpload);
$uploadBtn = new Button('upload');
$imgForm->addButtons($uploadBtn);
$imgForm->setEnctype("multipart/form-data");

$imgForm->render();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	var_dump($_FILES);
	$fsRoot = PathHelper::getFSRoot();
	$filepath = $fsRoot . "/images/temp/".$_FILES['img-upload']['name'];
	move_uploaded_file($_FILES['img-upload']['tmp_name'], $filepath);
?>
<canvas id="img-crop"></canvas>
	<script>
var canvas = document.querySelector("#img-crop");
var cxt = canvas.getContext("2d");

var upload = new Image();

upload.onload = function(){
	cxt.drawImage(upload, 0, 0);
}
upload.src = "<?php echo $filepath;?>";

	</script>
<?php

}



include '../footer.php';
