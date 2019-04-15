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
	$selectForm = new Form('select-form', 'ImgUploadTest.php', 'POST');
	$selectBtn = new Button('select-btn', 'Crop Selection');
	$selectForm->addButtons($selectBtn);
	$selectForm->render();
	var_dump($_FILES);
	$fsRoot = PathHelper::getFSRoot();
	$filepath = $fsRoot . "/images/temp/".$_FILES['img-upload']['name'];
	move_uploaded_file($_FILES['img-upload']['tmp_name'], $filepath);
?>
<canvas id="img-crop"></canvas>
	<script>

var selectButton = document.querySelector("select-btn");
var upload = new Image();

upload.onload = function(){
	var width = 900;
	var height = (upload.naturalHeight / upload.naturalWidth) * width;
	console.log({width, height});
	var canvas = document.querySelector("#img-crop");
	canvas.width =  width;
	canvas.height = height;
	var cxt = canvas.getContext("2d");
	var overlay = document.createElement("canvas");
	overlay.width = width;
	overlay.height = height;
	var overlayCxt = overlay.getContext("2d");
	overlayCxt.fillStyle = "grey";
	overlayCxt.globalAlpha = 0.5;
	var selection = {
		x: 0,
		y: 0,
		w: 200,
		h: 200,
		clear: function(c){
			c.clearRect(this.x, this.y, this.w, this.h);
		},
		scaleUp: function(){
			this.w += 10;
			this.h += 10;
		},
		scaleDown: function(){
			this.w -= 10;
			this.h -= 10;
		}
	}

	
	function draw(){
		overlayCxt.clearRect(0, 0, width, height);
		overlayCxt.fillStyle = "grey";
		overlayCxt.globalAlpha = 0.5;
		overlayCxt.fillRect(0, 0, width, height);
		selection.clear(overlayCxt);
		cxt.drawImage(upload, 0, 0, width, height);
		cxt.drawImage(overlay, 0, 0, width, height);
	}
	draw();	
	canvas.addEventListener("click", e => {
		Object.assign(selection, {
			x: (e.pageX - canvas.offsetLeft) - (selection.w / 2),
			y: (e.pageY - canvas.offsetTop) - (selection.h / 2)
		});
		if(selection.x < 0)
			selection.x = 0;
		else if(selection.x + selection.w > width)
			selection.x = width - selection.w;
		if(selection.y < 0)
			selection.y = 0;
		else if(selection.y + selection.h > height)
			selection.y = height - selection.h;
		draw();
	});
	window.addEventListener("keydown", e => {
		switch(e.keyCode){
			case 219:
				selection.scaleUp();
				draw();
				break;
			case 221:
				selection.scaleDown();
				draw();
				break;
			default:
				console.log(e.keyCode);

		}


	});
	
}

upload.src = "<?php echo $root . "/images/temp/".$_FILES['img-upload']['name'];?>";

	</script>
<?php

}



include '../footer.php';
