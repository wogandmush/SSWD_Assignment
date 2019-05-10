<?php
#
# This toolbar provides links to the various content management tools available to admin users
#

if($isAdmin){
?>

<nav id='admin-toolbar' class=''>
	<h5 class='text-info'>Manage Content: </h5>
	<ul class=''>
		<li>
			<a href="<?php echo $root;?>/feature_manage.php">Features</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/image_manage.php">Images</a>
		</li>
		<li>
			<a href="<?php echo $root;?>/fees_manage.php">Fees</a>
		</li>
<!--
		<li>
			<a href="<?php echo $root;?>/class_manage.php">Classes</a>
		</li>
-->
		<li>
			<a href="<?php echo $root;?>/testimonial_manage.php">Testimonials</a>
		</li>
	</ul>
</nav>
<?php
}
