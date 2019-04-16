<?php

class Testimonial implements Crudable, Component{
	private $name;
	private $message;
	private $class;
	private $date;
	public function __construct($name, $message, $class, $date = ""){
		$this->name = $name;
		$this->message = $message;
		$this->class = $class;
		$this->date = $date;
	}
	public function toArray(){
		return ["first_name"=>$this->name, "message"=>$this->message, "class_title"=>$this->class, "date"=>$this->date];
	}
	public function create(){
		$conn = DBConnect::getConnection();
		$sql = "INSERT INTO testimonial(first_name, message, class_title) VALUES(
			'".mysqli_real_escape_string($conn, $this->name)."',
			'".mysqli_real_escape_string($conn, $this->message)."',
			'".mysqli_real_escape_string($conn, $this->class)."'
			);";
				
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		return $result;
	}
	public static function read($conditions = "", $limit = 100, $order = ""){
		$conn = DBConnect::getConnection();
		$sql = "SELECT * FROM testimonial";
		if(!empty($conditions))
			$sql .= " $conditions";
		$sql .= " LIMIT $limit";
		if(!empty($order))
			$sql .= " ORDER BY $order";
		$sql .= ";";

		if($result = mysqli_query($conn, $sql)){
			$testimonials = array();
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$name = $row['first_name'];
				$message = $row['message'];
				$class = $row['class_title'];
				$date = $row['date'];
				$testimonials[] = new Testimonial($name, $message, $class, $date);
			}
			mysqli_close($conn);
			return $testimonials;
		}
		mysqli_close($conn);
		return false;
	}
	public function update($field, $value){
		$conn = DBConnect::getConnection();
		$sql = "UPDATE testimonial 
			SET $field = '$value' 
			WHERE first_name = '$this->name' 
			AND date = '$this->date';";
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
		$sql = "DELETE FROM testimonial WHERE first_name = '$this->name' AND date = '$this->date';";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		return $result;
	}
	public static function loadApproved(){
		return self::read("WHERE approved = 1");
	}
	public static function loadUnapproved(){
		return self::read("WHERE approved = 0");
	}
	public function render(){
		echo $this->getHTMLString();
	}
	public function getHTMLString(){
		$output = 
		"<div class='jumbotron testimonial mx-auto'>
			<blockquote>$this->message</blockquote>
			<p class='lead'>- $this->name ($this->class)</p>
			<small>$this->date</small>";
		$output .= "</div>";
		return $output;
	}
}
