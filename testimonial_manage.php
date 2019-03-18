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

<!-- an empty div, to which any messages will be appended via javascript -->
<div id="container">
</div>

<script>
	//select the div with id container
	var container = document.getElementById("container");


	//http GET request to be sent to testimonial_db.php
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'testimonial_db.php');
	xhr.onload = function(){ // function to be executed when response recieved
		var res = xhr.responseText; // assign response data to variable res
		if(res === ""){ //if there are no unapproved messages in database
			return; // add function to display no pending messages here
		}
		else{
			/*
				pending = array of not-yet-approved testimonials from database
			 */
			var pending = JSON.parse(xhr); 
			//create an HTML element for each message
			var messages = pending.map(msg => {

				// a div element for each message:
				let message = document.createElement("div");

				//inner html of the div:
				message.innerHTML = `
				<h1>${msg.first_name}</h1>
				<p>${msg.message}</p>
				`;

				//create a button element
				var button = document.createElement("button");
				button.textContent = "Delete";
				//add an event listener function to be executed when button
				//is clicked
				button.addEventListener("click", _=> {
					//reject sends request to delete message from db
					reject(msg.first_name, msg.date);

					//delete message from the page
					container.removeChild(message);
				});

				//append the button to the message div
				message.appendChild(button);

				//add message to the array, messages
				return message;
			});
			messages.forEach(message => {
				//append each message (div) to the container div
				container.appendChild(message);
			});
		}

	}
	//send request to get pending testimonials from db
	xhr.send();
	
	/*function executed when delete button is pressed
		* sends a post request to manage_db.php, with name
		* and time of the testimonial as parameters. 
		* (http DELETE request don't seem to be allowed on knuth)
	 */
	function reject(name, time){
		var deleteReq = new XMLHttpRequest();
		//DELETE doesn't seem to be allowed on knuth :(
		deleteReq.open("POST", "testimonial_db.php");
		deleteReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		//function to be executed when message deleted from db
		deleteReq.onload = function(){
			console.log(deleteReq);
			console.log(deleteReq.responseText);
		}
		//send request to delete the rejected testimonial
		deleteReq.send(`delete=true&name=${name}&time=${time}`);
	}


</script>

<?php
}
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
