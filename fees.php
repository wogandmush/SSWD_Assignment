<?php 
include_once 'header.php'; 
#^^this should be the first line of the file. Body tags are already opened

$fees = Fees::read("", "", 3);
?>
<section id='fees'>
<div class="container">
  <div class="row flex-items-xs-middle flex-items-xs-center">
    <!-- Table #1  -->
<?php
foreach($fees as $fee){
	$fee->render();
}
?>
  </div>
</div>
</section>
