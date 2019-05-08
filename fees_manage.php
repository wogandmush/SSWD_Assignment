<?php 
include 'header.php';
?>

<section id="fees-admin">
<div id="fees-admin-panel">
<?php
$feesAction = new Input('fees-action', '', 'hidden');
if($_SERVER['REQUEST_METHOD'] && isset($_GET['fees-action'])){
	$feesAction->setData($_GET['fees-action']);
} else {
	//$feesAction->setData('manage-existing');
}
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
$benefitCheck = new CheckBox('benefits', 'Select benefits');
$benefitCheck->setOptions($benefits);
$newPriceInput = new Input('new-price', 'Choose a new price: ', 'number');
$newPriceInput->setAttributes(['step'=>'0.01']);
switch($feesAction->getData()){
	case 'manage-existing':
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
			if(isset($_POST['new-price']) && $_POST['new-price'] > 0){
				$newPrice = $_POST['new-price'];
				if(!empty($newPrice)){
					$fees->setPrice($newPrice);
					$fees->update("price", $newPrice);
				}
			}
		}
		$benefitForm = new Form('manage-benefits');
		$benefitForm->addFields($feesAction, $feesSelect, $benefitCheck, $newPriceInput);
		$updateSubmit = new Button('update-submit', 'submit');
		$benefitForm->addButtons($updateSubmit);
		$benefitForm->render();
		echo "<a class='btn btn-secondary' href='fees_manage.php'>back</a>";
		break;
	case 'create-new':
		if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-submit'])){
			var_dump($_POST);
			$plan_name = $_POST['create-fees-name'];
			$plan_benefits = $_POST['benefits'];
			$plan_price = $_POST['new-price'];
			$plan_period = $_POST['create-fees-period'];
			$new_plan = new Fees($plan_name, $plan_price, $plan_period, $plan_benefits);
			$new_plan->render();
			$new_plan->create();
			exit();
		}
		$createForm = new Form('create-fees-plan');
		$createName = new Input('create-fees-name', 'Choose name for new fees plan');
		$createName->setRequired(true);
		$createPeriod = new Select('create-fees-period', 'Choose payment period:');
		$createPeriod->setOptions(['year', 'month', 'week', 'day']);
		$createPeriod->setRequired(true);
		$newPriceInput->setRequired(true);
		$createForm->addFields($feesAction, $createName, $benefitCheck, $newPriceInput, $createPeriod);
		$createSubmit = new Button('create-submit', 'Add Plan');
		$createForm->addButton($createSubmit);
		$createForm->render();
		echo "<a class='btn btn-secondary' href='fees_manage.php'>back</a>";
		break;
	default:
		echo "<h4>Choose an action</h4>";
?>

<button class='btn btn-primary' onClick='location.href="fees_manage.php?fees-action=manage-existing"'>Manage Existing</button>
<button class='btn btn-primary' onClick='location.href="fees_manage.php?fees-action=create-new"'>Add Fees Plan</button>
<?php
}

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
var shown = document.querySelector("#fees-select").value;
function showSelected(id){
	id = toSkeletonCase(id);
	shown = document.getElementById(id);
	$(fees).fadeOut()
	setTimeout(()=>$(shown).fadeIn(), 400);
}
showSelected(shown);
$('#fees-select').on('change', e => showSelected(e.target.value));

</script>
</section>
<?php
include 'footer.php';
