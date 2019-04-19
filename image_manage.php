<section id='img-upload'>
<?php
include './header.php';

if(!isset($_FILES['img-uplad'])){
$imgForm = new Form('img-form', 'ImgUploadTest.php', 'POST');
$imgUpload = new Input('img-upload', 'Upload an new image: ', 'file');

$imgForm->addFields($imgUpload);
$imgForm->setClassList("mx-auto");
$uploadBtn = new Button('upload');
$imgForm->addButtons($uploadBtn);
$imgForm->setEnctype("multipart/form-data");
$imgForm->render();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$selectBtn = new Button('select-btn', 'Crop Selection');
	$selectBtn->render();
	$category = new Select('img-category', 'Choose image category');
	$categories = IOHelper::getDirectories("$fsRoot/images");
	$category->setOptions($categories);
	$category->render();
	$filename = new Input("file-name", "Choose name for image");
	$filename->render();
	$filepath = $fsRoot . "/images/temp/".$_FILES['img-upload']['name'];
	move_uploaded_file($_FILES['img-upload']['tmp_name'], $filepath);
?>
<canvas id="img-crop"></canvas>
</section>
	<script>
const ASPECT_RATIO_WIDTH = 3;
const ASPECT_RATIO_HEIGHT = 4;
const ASPECT_RATIO = ASPECT_RATIO_WIDTH/ASPECT_RATIO_HEIGHT;
const MAX_SIZE = 2000000; // roughly caps file size at 200Kb
const MAX_WIDTH = Math.sqrt(MAX_SIZE) * Math.sqrt(ASPECT_RATIO_HEIGHT/ASPECT_RATIO_WIDTH);
const MAX_HEIGHT = Math.sqrt(MAX_SIZE) * Math.sqrt(ASPECT_RATIO_WIDTH/ASPECT_RATIO_HEIGHT);
var selectButton = document.querySelector("#select-btn");
var imgCategory = document.querySelector("#img-category");
var fileName = document.querySelector("#file-name");

var upload = new Image();
upload.onload = function(){
	var natWidth = upload.naturalWidth, natHeight = upload.naturalHeight;
	var width = 900;
	var height = (natHeight / natWidth) * width;
	var scaleX = natWidth / width;
	var scaleY = natHeight / height;
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
		var tempCanv = document.createElement("canvas");
		var tempCxt = tempCanv.getContext("2d");
		/* This can be changed to absolute dimensions */
		let w = selection.w * scaleX, h = selection.h * scaleY;
		if(w < MAX_WIDTH && h < MAX_HEIGHT){
			tempCanv.width = w;
			tempCanv.height = h;
		}
		else{
			tempCanv.width = MAX_WIDTH;
			tempCanv.height = MAX_HEIGHT;
		}
		console.log({MAX_WIDTH, MAX_HEIGHT});
		console.log({width: tempCanv.width, height: tempCanv.height});
		tempCxt.drawImage(upload,
			selection.x * scaleX, selection.y * scaleY, selection.w * scaleX, selection.h * scaleY,
			0, 0, tempCanv.width, tempCanv.height);
		tempCanv.toBlob(sendBlob, "image/jpeg");
			
		function sendBlob(blob){
			console.log({blob});
			var fd = new FormData();
			fd.append("image", blob);
			fd.append("img-category", imgCategory.value);
			fd.append("file-name", fileName.value);
			console.log(fd);
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "img_db.php", true);
			xhr.onload = function(){
				var res = xhr.responseText;
				console.log(res);
			}
			xhr.send(fd);
		};
	}
}
upload.src = "<?php echo $root . "/images/temp/".$_FILES['img-upload']['name'];?>";
	</script>
<?php
}
include './footer.php';
