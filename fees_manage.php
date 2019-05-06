<?php 
include 'header.php';

$fees = new Fees("Hello", "poo", "period");

$conn = DBConnect::getConnection();
$sql = "SELECT * FROM benefit";
$result = mysqli_query($conn, $sql);
if($error = mysqli_error($conn)){
	echo "<h4 class='text-warning'>Database error occurred</h4>";
	exit();
}
$benefits = array();
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$benefits[] = $row['benefit'];
}
$benefitCheck = new CheckBox('benefits', 'Select benefits');
$benefitCheck->setOptions($benefits);
$benefitCheck->render();

$Allfees = Fees::read();
?>

  <div class="container">
  <div class="row flex-items-xs-middle flex-items-xs-center">
<?php
foreach($Allfees as $fee){

	$fee->updateBenefits();
	$fee->render();
}
?>
</div>
</div>
<?php

