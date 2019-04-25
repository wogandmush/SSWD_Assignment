<?php

class Feature implements Crudable, Component{
	private $id;
	private $title;
	private $detail;
	private $image_url;
	private $link;
	private $feature_number;
	private $classList;
	public function __construct($id, $title, $detail, $image_url, $link = "", $feature_number = ""){
		$this->id = $id;
		$this->title = $title;
		$this->detail = $detail;
		$this->image_url = $image_url;
		$this->link = $link;
		$this->feature_number = $feature_number;
		$this->classList = "feature";
	}
	public function getId(){
		return $this->id;
	}
	public function getImageURL(){
		return $this->image_url;
	}
	public function setImageURL($image_url){
		$this->image_url = $image_url;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function getDetail(){
		return $this->detail;
	}
	public function setDetail($detail){
		$this->detail = $detail;
	}
	public function getLink(){
		return $this->link;
	}
	public function setLink($link){
		$this->link = $link;
	}
	public function create(){
		$conn = DBConnect::getConnection();
		$temp_title = mysqli_real_escape_string($conn, $this->title);
		$temp_detail = mysqli_real_escape_string($conn, $this->detail);
		$temp_image_url = mysqli_real_escape_string($conn, $this->image_url);
		$sql = "INSERT INTO feature(feature_title, detail, img_url) 
					VALUES('$temp_title', '$temp_detail', '$temp_image_url')";
		if($result = mysqli_query($conn, $sql)){
			mysqli_close($conn);
			return $result;
		}

		$err = mysqli_error($conn);
		mysqli_close($conn);
		return $err;
	}
	public static function read($conditions = "", $order = "", $limit = 100){
		$conn = DBConnect::getConnection();
		$sql = "SELECT * FROM feature";
		if(!empty($conditions))
			$sql .= " $conditions";
		if(!empty($order))
			$sql .= " ORDER BY $order";
		$sql .= " LIMIT $limit";
		$sql .= ";";

		if($result = mysqli_query($conn, $sql)){
			$features = array();
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$id = $row['id'];
				$title = $row['feature_title'];
				$details = $row['detail'];
				$image_url = $row['img_url'];
				$link = $row['link'];
				$features[] = new Feature($id, $title, $details, $image_url, $link);
			}
			mysqli_close($conn);
			return $features;
		}
		mysqli_close($conn);
		return false;
	}
	public function update($field, $value){
		$conn = DBConnect::getConnection();
		$sql = "";
		if(empty($value))
			$sql .= "UPDATE feature SET $field = NULL WHERE id = '$this->id';";
		else $sql .= "UPDATE feature
			SET $field = '$value'
			WHERE id = '$this->id';";
		echo "<h4 class='text-warning'>$sql</h4>";
		$result = mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		mysqli_close($conn);
		return $result;
	}
	public function delete(){
		$conn = DBConnect::getConnection();
		$sql = "DELETE FROM testimonial 
			WHERE id = '$this->id';";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		return $result;
	}
	public function setClassList($classList){
		$this->classList = $classList;
	}
	public static function getFeatured(){
		return self::read("RIGHT JOIN featured ON feature.id = featured.feature_id", "feature_number", 3);
	}
	public static function getNonFeatured(){
		// select all features not in featured table
		return self::read("LEFT JOIN featured ON feature.id = featured.feature_id WHERE feature_id IS NULL");		
	}
	public static function setFeatured($featureId, $featureNo){
		$conn = DBConnect::getConnection();
		$sql = "UPDATE featured
			SET feature_id = '$featureId'
			WHERE feature_number = '$featureNo';";
		$result = mysqli_query($conn, $sql);
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
		$output = 
		"<div id='feature-$this->id' class='$this->classList'>
			<h1>$this->title</h1>
			<div class='feature-content'>
				<img src='$this->image_url' />
				<p>$this->detail</p>
			</div>";
		if(isset($this->link)) 
			$output .="<a href='$this->link'>Read more</a>";
		$output .= "</div>";
		return $output;
	}
}
