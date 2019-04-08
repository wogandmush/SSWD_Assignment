<?php 
include 'header.php'; 

if(isset($_SESSION['membership'])){
   
	if($_SESSION['membership'] === "admin"){
	// if user is admin, echo link to testmonial_manage page
	echo "<div><a href='testimonial_manage.php'>Manage Testimonials</a></div>";
	}
	echo "<a href='testimonial_add.php'>Add a testimonial</a>";
}

// get $conn connection resource for db work
$conn = DBConnect::getConnection();

// get all admin-approved testimonial from database (approved = 1)
$sql = "SELECT * FROM testimonial WHERE approved = 1 ORDER BY date DESC LIMIT 5";

if($result = mysqli_query($conn, $sql)){
	$testimonials = array();
	// div to contain all testimonials
	echo "<div class='container' id='testimonial-container'>";
	while($row = mysqli_fetch_array($result)){
		$name = $row['first_name'];
		$message = $row['message'];
		$class = $row['class_name'];
		$date = $row['date'];
		$testimonials[] = new Testimonial($name, $message, $class, $date);
	}
	foreach($testimonials as $testimonial){
		$testimonial->render();
	}
	echo "</div>";
}
// close the database connection
mysqli_close($conn);
?>

<script>
var testimonials = document.getElementsByClassName('testimonial');
var shownIndex = Math.floor(Math.random() * testimonials.length);
var oldIndex;
var shown = testimonials[shownIndex];
var fadeTime = 800;
var delayTime = 4000;
(function changeShown(){
	// ensure that same message is not displayed twice in succession
	oldIndex = shownIndex; 
	while(oldIndex === shownIndex) 
		shownIndex = Math.floor(Math.random() * testimonials.length);
	shown = testimonials[shownIndex];
	$(shown)
		.fadeIn(fadeTime)
		.delay(delayTime)
		.fadeOut(fadeTime, changeShown);
})();
</script>

<?php
include 'footer.php';
?>
