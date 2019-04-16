<section id='img-upload'>
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
	$selectBtn = new Button('select-btn', 'Crop Selection');
	$selectBtn->render();
	
	var_dump($_FILES);
	$fsRoot = PathHelper::getFSRoot();
	$filepath = $fsRoot . "/images/temp/".$_FILES['img-upload']['name'];
	move_uploaded_file($_FILES['img-upload']['tmp_name'], $filepath);
?>
<canvas id="img-crop"></canvas>
</section>
	<script>
var selectButton = document.querySelector("#select-btn");
var upload = new Image();
upload.onload = function(){
	var natWidth = upload.naturalWidth, natHeight = upload.naturalHeight;
	var imgScale = 900 / natWidth;
	var width = 900;
	var height = (natHeight / natWidth) * width;
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
	const ASPECT_RATIO = 1/2;
	var selection = {
		x: 0,
		y: 0,
		w: 200,
		h: 200 * ASPECT_RATIO,
		clear: function(c){
			c.clearRect(this.x, this.y, this.w, this.h);
		},
		move(x, y){
			this.x += x;
			this.y += y;
			if(this.x < 0)
				this.x = 0;
			else if(this.x + this.w > width)
				this.x = width - this.w;
			if(this.y < 0)
				this.y = 0;
			else if(this.y + this.h > height)
				this.y = height - this.h;
		},
		scaleUp: function(pix){
			this.w += pix;
			this.h += pix;
			let offsetX = -pix/2;
			let offsetY = offsetX * ASPECT_RATIO;
			this.move(offsetX, offsetY);
		},
		scaleDown: function(pix){
			this.w -= pix;
			this.h -= pix;
			let offsetX = pix/2;
			let offsetY = offsetX * ASPECT_RATIO;
			this.move(offsetX, offsetY);
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
		selection.move(0, 0);
		draw();
	});
	window.addEventListener("keydown", e => {
		switch(e.keyCode){
			case 219:
				selection.scaleUp(10);
				draw();
				break;
			case 221:
				selection.scaleDown(10);
				draw();
				break;
			default:
				console.log(e.keyCode);
		}
	});
	selectButton.addEventListener("click", submitImage);
	function submitImage(){
		//var imgData = cxt.getImageData(selection.x, selection.y, selection.w, selection.h);
		var tempCanv = document.createElement("canvas");
		var tempCxt = tempCanv.getContext("2d");
		/*
		tempCanv.width = imgData.width;
		tempCanv.height = imgData.height;
		tempCxt.putImageData(imgData, 0, 0);
		 */
		tempCanv.width = natWidth;
		tempCanv.height = natHeight;
		tempCxt.drawImage(upload,
			selection.x * imgScale, selection.y * imgScale, selection.w * imgScale, selection.h * imgScale,
			0, 0, natWidth, natHeight);
		tempCanv.toBlob(blob => {
			var fd = new FormData();
			fd.append("image", blob);
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "ImgUploadDb.php", true);
			xhr.onload = function(){
				var res = xhr.responseText;
				console.log(res);
			}
			xhr.send(fd);
		});
	}
}
upload.src = "<?php echo $root . "/images/temp/".$_FILES['img-upload']['name'];?>";
	</script>
<?php
}
include '../footer.php';
