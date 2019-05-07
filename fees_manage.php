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
	$benefits[$benefit] = $benefit;
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
	$label = $row['membership_type'];
	$value = StringHelper::toSkeletonCase($label);
	$membership_types[$label] = $value;
}
mysqli_free_result($result);
mysqli_close($conn);

$feesSelect = new Select('fees-select', 'Choose fees scheme to edit');

$feesSelect->setOptions($membership_types);


$Allfees = Fees::read();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$selectedPlan = $_POST['fees-select'];
	$feesSelect->setData($selectedPlan);
	$fees = $Allfees[$selectedPlan];
	if(isset($_POST['benefits'])){
		$selectedBenefits = $_POST['benefits'];
		if(!empty($selectedBenefits)){
			$fees->setBenefits($selectedBenefits);		
			$fees->updateBenefits();
		}
	}
	if(isset($_POST['new-price'])){
		$newPrice = $_POST['new-price'];
		$newPrice = number_format((float)$newPrice, 2, ".", "");
		if(!empty($newPrice)){
			$fees->setPrice($newPrice);
			$fees->update("price", $newPrice);
		}
	}
}

$benefitForm = new Form('manage-benefits');
$benefitCheck = new CheckBox('benefits', 'Select benefits');
$benefitCheck->setOptions($benefits);
$newPriceInput = new Input('new-price', 'Choose a new price: ', 'number');
$newPriceInput->setAttributes(['step'=>'0.01']);

$benefitForm->addFields($feesSelect, $benefitCheck, $newPriceInput);
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
var shown;
<?php
if(isset($selectedPlan)){
echo "shown = document.querySelector('#$selectedPlan');
$(shown).show();";
}?>

$('#fees-select').on('change', function(e){
	var id = e.target.value;
	id = toSkeletonCase(id);
	shown = document.getElementById(id);
	$(fees).fadeOut()
	setTimeout(()=>$(shown).fadeIn(), 400);
});
</script>
</section>
<?php
include 'footer.php';
