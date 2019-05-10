<?php 
include_once 'header.php'; 

#
# This file is included in index.php
#
# It display three fees plans from the database
# 
# Each fees plan has a link to register.php
# if the link is followed, the membership select field
# of the form will automatically be set, depending on the
# fees plan clicked
#

$fees = Fees::read("", "", 3);
?>
<section id='fees'>
<div class="container">
  <div class="row flex-items-xs-middle flex-items-xs-center">
<?php
foreach($fees as $fee){
	$fee->render();
}
?>
  </div>
</div>
</section>
