<?php

include './header.php';

$testimonials;
if(isset($_GET['manage_approved']))
	$testimonials = Testimonial::loadApproved();
else $testimonials = Testimonial::loadUnapproved();
?>
	<section id='testimonials'>
	   	<div class='container' id='testimonial-container'>
<?php
if(isset($_GET['manage_approved']))
	echo "<button onclick='location.href=`testimonial_manage.php`;'>Manage unapproved</button>";
else {
	echo "<form action='testimonial_manage.php' method='GET'>
			<button type='submit' name='manage_approved'>Manage approved</button>
		</form>";
}
if($testimonials){
	$approveBtn = new Button("approve");
	$unapproveBtn = new Button("unapprove");
	$unapproveBtn->setClassList("btn btn-warning");
	$deleteBtn = new Button("delete");
	$deleteBtn->setClassList("test-admin btn btn-danger");
	echo "<div class='admin-btns'>
			<div class='admin back-btn'></div>";
	if(isset($_GET['manage_approved']))
		$unapproveBtn->render();
	else $approveBtn->render();
	echo "<h4 id='admin-info'></h4>";
	$deleteBtn->render();
	echo "<div class='admin fwd-btn'></div>
		</div>";
	foreach($testimonials as $testimonial){
		$testimonial->render();
	}
}
?>
		</div>
	</section>
<script>

var testimonials = $('.testimonial');
$(testimonials).hide();
var index = 0, num = testimonials.length;
console.log(num);
var sorted = new Set();
var info = document.getElementById("admin-info");
const updateInfo = _ => {
let currentIndex = index + 1;
let less = [...sorted].filter(x => x < currentIndex).length;
info.textContent = `${(currentIndex-less)} / ${num - sorted.size} Testimonials`;
}
updateInfo();
$(testimonials[index]).show();
const showPrev = _ => {
	$(testimonials[index]).hide();
	do{
		index--;
		if(index < 0)
			index = num-1;
	}while(sorted.has(index));
	console.log(index);
	$(testimonials[index]).show();
	updateInfo();
}
const showNext = _ => {
	$(testimonials[index]).hide();
	do{
		index++;
		if(index >= num)
			index = 0;
	}
	while(sorted.has(index));
	$(testimonials[index]).show();
	updateInfo();
}
var backBtn = document.querySelector(".back-btn");
backBtn.addEventListener("click", showPrev);
var forwardBtn = document.querySelector(".fwd-btn");
forwardBtn.addEventListener("click", showNext);

var json = <?php echo json_encode(array_map(function($testimonial){
	return $testimonial->toArray();
}, $testimonials)); ?>;

const testimonialAction = action => {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "testimonial_db.php");
	xhr.onload = function(){
		var res = xhr.responseText;
		console.log(res);
		sorted.add(index);
		if(sorted.size < testimonials.length)
			showNext();
		else location.href="testimonial_manage.php";
	}	
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	var payload = Object.entries({...json[index], [action]: true}).map(x => x.join("=")).join("&");
	xhr.send(payload);
}

var deleteBtn = document.querySelector("#delete");
deleteBtn.addEventListener("click", _ => testimonialAction("delete"));
var approveBtn = document.querySelector("#approve");
if(approveBtn)
	approveBtn.addEventListener("click", _ => testimonialAction("approve"));
var unapproveBtn = document.querySelector("#unapprove");
if(unapproveBtn)
	unapproveBtn.addEventListener("click", _ => testimonialAction("unapprove"));
</script>
<?php
include './footer.php';
