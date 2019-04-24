function createImageGallery(gallery, categorySelect, imageInput){
	var images = [];
	categorySelect.addEventListener("change", getImages);
	function getImages(e){
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
				imageInput.value = this.src;
			});
		}
		xhr.send();
	};
	getImages({target: categorySelect});
}
