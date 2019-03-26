<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened

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

	//when page loaded, http GET request sent to testimonial_db.php
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'testimonial_db.php');
	xhr.onload = function(){ // function to be executed when response recieved
		//console.log(xhr);
		var res = xhr.responseText; // assign response data to variable res

		if(res === ""){ //if there are no unapproved messages in database
			noPending();
		}
		else{
			/*
				pending = array of not-yet-approved testimonials from database
			 */
			var pending = JSON.parse(xhr.responseText); 
			//create an HTML element for each message
			var messages = pending.map(msg => {

				// a div element for each message:
				let message = document.createElement("div");

				// inner html of the div:
				message.innerHTML = `
				<h1>${msg.first_name}<\/h1>
				<p>${msg.message}<\/p>
				<small>${msg.date}<\/small>
				<br\/>
				`;

				var approveBtn = document.createElement("button");
				approveBtn.textContent = "Approve";
				approveBtn.className = "btn btn-success btn-sm";
				approveBtn.addEventListener("click", _=> {
					post("approve", msg.first_name, msg.date);
					container.removeChild(message);
					if(container.children.length === 0){
						noPending();
					}
				});

				message.appendChild(approveBtn);

				//create a button element
				var rejectBtn = document.createElement("button");
				rejectBtn.textContent = "Reject";
				//add an event listener function to be executed when button
				//is clicked
				rejectBtn.className = "btn btn-danger btn-sm";
				rejectBtn.addEventListener("click", _=> {
					//reject sends request to delete message from db
					post("delete", msg.first_name, msg.date);

					//delete message from the page
					container.removeChild(message);

					if(container.children.length === 0){
						noPending();
					}
				});

				//append the button to the message div
				message.appendChild(rejectBtn);
				message.style.margin = "10px auto";

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
	function post(action, name, time){
		var req = new XMLHttpRequest();
		//DELETE doesn't seem to be allowed on knuth :(
		req.open("POST", "testimonial_db.php");
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		//function to be executed when message deleted from db
		req.onload = function(){
			console.log(req.responseText);
		}
		//send request to delete the rejected testimonial
		req.send(`${action}=true&name=${name}&time=${time}`);
	}

	//function to display a message when no messages awaiting review
	function noPending(){
		//create a div element
		var message = document.createElement("div");
		//set the content of the element
		message.innerHTML = `
			<h3 class='text-success'>There are no testimonials pending approval at this time<\/h3>
			<button class='btn btn-primary' onclick='location.href="testimonial.php"'>Return to testimonials page<\/button>
		`;
		//append the element to the container
		container.appendChild(message);
	}

</script>

<?php
}
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
