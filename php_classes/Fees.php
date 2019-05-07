<?php
class Fees implements Crudable, Component{
	private $name;
	private $price;
	private $period;
	private $benefits;
	public function __construct($name = "", $price = 0, $period = "", $benefits = array()){
		$this->name = $name;
		$this->price = $price;
		$this->period = $period;
		$this->benefits = $benefits;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getPrice(){
		return $this->price;
	}
	public function setPrice($price){
		$this->price = $price;
	}
	public function getPeriod(){
		return $this->period;
	}
	public function addBenefit($benefit){
		$this->benefits[] = $benefit;
	}
	public function setBenefits($benefits){
		$this->benefits = $benefits;
	}
	public function getBenefits(){
		return $this->benefits;
	}
	public function create(){
		$conn = DBConnect::getConnection();
		mysqli_close($conn);
	}
	public static function read($conditions = "", $order = "", $limit = 100){
		$conn = DBConnect::getConnection();
		$sql = "SELECT * FROM fees";
		if(!empty($conditions))
			$sql .= " $condition";
		if(!empty($order))
			$sql .= " ORDER BY $order";
		$sql .= " LIMIT $limit";
		$sql .= ";";

		if($result = mysqli_query($conn, $sql)){
			$fees = array();
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$name = $row['membership_type'];
				$price = $row['price'];
				$period = $row['period'];
				$fees[] = new Fees($name, $price, $period);
			}
			mysqli_free_result($result);
			foreach($fees as $fee){
				$sql = "SELECT benefit FROM fees_benefit WHERE membership_type = '$fee->name'";
				if($result = mysqli_query($conn, $sql)){
					$benefits = array();
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$fee->addBenefit($row['benefit']);
					}
				}
			}
			mysqli_free_result($result);
			mysqli_close($conn);
			return $fees;
		}
		mysqli_close($conn);
		return false;
	}
	public function update($field, $value){
		$conn = DBConnect::getConnection();
		$sql = "UPDATE fees SET $field = '$value' WHERE membership_type = '$this->name'";
		$result = mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		mysqli_close($conn);
		return $result;
	}
	public function updateBenefits(){
		$conn = DBConnect::getConnection();
		$sql = "DELETE FROM fees_benefit WHERE membership_type = '$this->name'";
		$result = mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		if(sizeof($this->benefits) === 0) return;
		$updateSql = "INSERT INTO fees_benefit VALUES";
		$updateSql .= implode(", ", array_map(function($benefit){
			return "('$this->name', '$benefit')";
		}, $this->benefits));
		$result = mysqli_query($conn, $updateSql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		mysqli_close($conn);
		return $result;
	}
	public function delete(){
		$conn = DBConnect::getConnection();
		$sql = "DELETE FROM fees WHERE membership_type = '$this->name'";
		$result - mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		mysqli_close($conn);
		return $result;
	}
	public function render(){
		echo $this->getHTMLString();
	}
	public function getHTMLString(){
		$html = "
    <div id='".StringHelper::toSkeletonCase($this->name)."' class='fees col-xs-12 col-lg-4'>
      <div class='card text-xs-center'>
        <div class='card-header'>
          <h3 class='display-2'><span class='currency'>€</span>$this->price<span class='period'>/$this->period</span></h3>
        </div>
        <div class='card-block'>
          <h4 class='card-title'>$this->name</h4>
          <ul class='list-group'>";
	foreach($this->benefits as $benefit){
		$html .= "<li class='benefit list-group-item'>$benefit</li>";
	}
	$html .= "
          </ul>
          <a href='register.php' class='btn btn-gradient mt-2'>Choose Plan</a>
        </div>
      </div>
    </div>";
return $html;
	}
}
