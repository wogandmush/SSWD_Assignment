<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened

$_SESSION['is_admin'] = 1;
if(!$_SESSION['is_admin']){
	header('Location: index.php');
	exit();
}
else {
?>

<div id="container">

</div>

<script>
	var container = document.getElementById("container");
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'testimonial_db.php');
	xhr.onload = function(){
		console.log(xhr);
		console.log(xhr.responseText);
		var pending = JSON.parse(xhr.responseText);
		var messages = pending.map(x => {
			let message = document.createElement("p");
			message.textContent = x.message;
			return message;
		});
		messages.forEach(message => {
			container.appendChild(message);
		});

	}
	xhr.send();

</script>

<?php
}
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
