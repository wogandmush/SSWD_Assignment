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
	function reject(name, time){
		console.log(name, time);
		var deleteReq = new XMLHttpRequest();
		deleteReq.open("POST", "testimonial_db.php");
		deleteReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		deleteReq.onload = function(){
			console.log(deleteReq);
			console.log(deleteReq.responseText);
		}
		deleteReq.send(`delete=true&name=${name}&time=${time}`);
	}


	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'testimonial_db.php');
	xhr.onload = function(){
		console.log(xhr);
		console.log(xhr.responseText);
		var pending = JSON.parse(xhr.responseText);
		var messages = pending.map(x => {
			let message = document.createElement("div");
			message.innerHTML = `
			<h1>${x.first_name}</h1>
			<p>${x.message}</p>
			`;
			var button = document.createElement("button");
			button.textContent = "Delete";
			button.addEventListener("click", _=> {
				reject(x.first_name, x.date);
				container.removeChild(message);
			});
			message.appendChild(button);

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
