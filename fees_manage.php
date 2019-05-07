<?php 
include 'header.php';
?>

<section id="fees-admin">
<div id="fees-admin-panel">
<?php
$conn = DBConnect::getConnection();
$sql = "SELECT * FROM benefit";
$result = mysqli_query($conn, $sql);
if($error = mysqli_error($conn)){
	echo "<h4 class='text-warning'>Database error occurred</h4>";
	mysqli_close($conn);
	exit();
}
$benefits = array();
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$benefit = $row['benefit'];
	$benefits[$benefit] = StringHelper::toSkeletonCase($benefit);
}
mysqli_free_result($result);

$sql = "SELECT membership_type FROM fees";
$result = mysqli_query($conn, $sql);

if($error = mysqli_error($conn)){
	echo "<h4 class='text-warning'>Something went wrong</h4>";
	mysqli_close($conn);
	exit();
}
$membership_types = array();
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$membership_types[] = $row['membership_type'];
}
mysqli_free_result($result);
mysqli_close($conn);

$feesSelect = new Select('fees-select', 'Choose fees scheme to edit');

$feesSelect->setOptions($membership_types);

$Allfees = Fees::read();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$selectedBenefits = $_POST['benefits'];
	foreach($Allfees as $fees){
		$fees->setBenefits($selectedBenefits);		
	}
}

$benefitForm = new Form('manage-benefits');
$benefitCheck = new CheckBox('benefits', 'Select benefits');
$benefitCheck->setOptions($benefits);
$benefitForm->addFields($feesSelect, $benefitCheck);
$benefitSubmit = new Button('benefit-submit', 'submit');
$benefitForm->addButton($benefitSubmit);
$benefitForm->render();

?>
</div>
<div id='fees-preview'>
<?php
foreach($Allfees as $fee){
	$fee->updateBenefits();
	$fee->render();
}
?>
</div>
<script>
var fees = document.querySelectorAll('.fees');
function toSkeletonCase(str){
	return str.toLowerCase().replace(' ', '-');
}
$(fees).hide();

$('#fees-select').on('change', function(e){
	var id = e.target.value;
	id = toSkeletonCase(id);
	console.log(id);
	var shown = document.getElementById(id);
	$(fees).fadeOut()
	setTimeout(()=>$(shown).fadeIn(), 400);
});
</script>
</section>
<?php
include 'footer.php';
