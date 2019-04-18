<?php
class Feature implements Crudable, Component{
	private $id;
	private $title;
	private $detail;
	private $image_url;
	private $link;
	private $feature_number;
	public function __construct($id = "", $title, $detail, $image_url, $link = "", $feature_number = ""){
		$this->id = $id;
		$this->title = $title;
		$this->detail = $detail;
		$this->image_url = $image_url;
		$this->link = $link;
		$this->feature_number = $feature_number;
	}
	public function create(){
		$conn = DBConnect::getConnection();
		$title = mysqli_real_escape_string($conn, $this->title);
		$detail = mysqli_real_escape_string($conn, $this->detail);
		$image_url = mysqli_real_escape_string($conn, $this->image_url);
		$sql = "INSERT INTO feature(title, detail, image_url) 
					VALUES('$title', '$detail', '$image_url')";
		if($result = mysqli_query($conn, $sql)){
			mysqli_close($conn);
			return result;
		}
		$err = mysqli_error($conn);
		mysqli_close($conn);
		return $err;
	}
	public static function read($conditions = "", $limit = 100, $order = ""){
		$conn = DBConnect::getConnection();
		$sql = "SELECT * FROM feature";
		if(!empty($conditions))
			$sql .= " $conditions";
		$sql .= " LIMIT $limit";
		if(!empty($order))
			$sql .= " ORDER BY $order";
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
		$sql = "UPDATE feature
			SET $field = '$value'
			WHERE id = '$this->id';";
		$result = mysqli_query($conn, $sql);
		if($error = mysqli($conn)){
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
	public static function getFeatured(){
		//$condition = "";
		return self::read("WHERE id IN (SELECT feature_id FROM featured)");
	}
	public function render(){
		echo $this->getHTMLString();
	}
	public function getHTMLString(){
		$output = 
		"<div id='$this->id' class='feature'>
			<h1>$this->title</h1>
			<p>$this->detail</p>
			<img src='$this->image_url' />
			<a href='$this->link'>Read more</a>
		</div>";
		return $output;
	}
}
