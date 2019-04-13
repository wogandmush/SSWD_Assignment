<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE){
?>

<nav id='admin-toolbar' class=''>
	<h5 class='text-info'>Manage Content: </h5>
	<ul class=''>
		<li>
			<a href="<?php echo $root;?>/feature_manage.php">Features</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/fees_manage.php">Fees</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/class_manage.php">Classes</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/testimonial_manage.php">Testimonals</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/contact_manage.php">Enquiries</a>
		</li>
	</ul>
</nav>
<?php
}
