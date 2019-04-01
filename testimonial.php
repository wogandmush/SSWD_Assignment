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

	// div to contain all testimonials
	echo "<div id='testimonial-container'>";
	while($row = mysqli_fetch_array($result)){

		// create testimonial string using values from each row
		echo
		"<div class='testimonial'>
			<p>${row['message']}</p>
			<span><strong>- ${row['first_name']}</strong> (${row['class_name']})
				<br/>
				<small>${row['date']}</small>
			</span>
		</div>";
	}
	echo "</div>";
}
// close the database connection
mysqli_close($conn);

include 'footer.php';
?>
