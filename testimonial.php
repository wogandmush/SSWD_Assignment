<?php 
include 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened


if($_SESSION['is_admin']){

	echo "<div><a href='testimonial_manage.php'>Manage Testimonials</a></div>";

}

$_SESSION['user_no'] = 1;
if(isset($_SESSION['user_no'])){

	echo "<a href='testimonial_add.php'>Add a testimonial</a>";

}

include '../config/connect.php';

$sql = "SELECT * FROM testimonial WHERE approved = 1 ORDER BY date DESC";
if($result = mysqli_query($conn, $sql)){

	while($row = mysqli_fetch_array($result)){

		echo "<div class='testimonial'>
			<p>${row['message']}</p>
			<span><strong>- ${row['first_name']}</strong> (${row['class_name']})
				<br/>
				<small>${row['date']}</small>
</span>
			
			</div>";

		/*
		foreach($row as $key=>$value){
			if(is_numeric($key))
				continue;
			echo "<p><strong>$key</strong>: $value</p>";
			
		}
		echo "</div>";
		 */

	}

}



?>

<?php
#vv this should be the last line. body and html tags are closed
include 'footer.php';
?>
