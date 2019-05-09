<?php

class Contact implements Crudable, Component{
	private $name;
	private $email;
	private $subject;
	private $message;
	private $mobile;
	private $hashkey;
	private $date;

	public function __construct($name, $email, $subject, $message, $mobile = "", $hashkey = "", $date = ""){
		$this->name = $name;
		$this->email = $email;
		$this->subject = $subject;
		$this->message = $message;
		$this->mobile = $mobile;
		$this->hashkey = $hashkey;
		if(empty($date))
			$this->date = time();
		else 
			$this->date = $date;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function getSubject(){
		return $this->subject;
	}
	public function setSubject($subject){
		$this->subject = $subject;
	}
	public function getMessage(){
		return $this->message;
	}
	public function setMessage($message){
		$this->message = $message;
	}
	public function getMobile(){
		return $this->mobile;
	}
	public function setMobile($mobile){
		$this->mobile = $mobile;
	}
	public static function createKey($email, $subject){
		return md5($email.$subject);		
	}
	public function getKey(){
		if(empty($this->hashkey))
			$this->setKey();
		return $this->hashkey;
	}
	public function setKey(){
		$this->hashkey = self::createKey($this->email, $this->subject);
	}
	public function create(){
		$conn = DBConnect::getConnection();
		$name = mysqli_real_escape_string($conn, $this->name);
		$email = mysqli_real_escape_string($conn, $this->email);
		$mobile = mysqli_real_escape_string($conn, $this->mobile);
		$subject = mysqli_real_escape_string($conn, $this->subject);
		$message = mysqli_real_escape_string($conn, $this->message);
		$hashkey = $this->getKey();
		$sql = "INSERT INTO contact(name, email, mobile, subject, message, hashkey) VALUES(
			'$name',
			'$email',
			'$mobile',
			'$subject',
			'$message',
			'$hashkey')";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			echo $error;
			return $error;
		}
		if($result){
			echo "<h4 class='text-success'>Success!</h4>";
		}
		mysqli_close($conn);
		return $result;
	}
	public static function read($conditions = "", $order = "", $limit = 100){
		$conn = DBConnect::getConnection();
		$sql = "SELECT * FROM contact";
		if(!empty($conditions))
			$sql .= " $conditions";
		if(!empty($order))
			$sql .= " ORDER BY $order";
		$sql .= " LIMIT $limit";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		if($error = mysqli_error($conn)){
			mysqli_close($conn);
			return $error;
		}
		$contact_messages = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$name = $row['name'];
			$email = $row['email'];
			$mobile = $row['mobile'];
			$subject = $row['subject'];
			$message = $row['message'];
			$hashkey = $row['hashkey'];
			$date = $row['date'];
			$contact_messages[] = new Contact($name, $email, $subject, $message, $mobile, $hashkey, $date);
		}
		mysqli_free_result($result);
		mysqli_close($conn);
		return $contact_messages;
	}
	public function update($field, $value){

	}
	public function delete(){
		
	}
	public static function deleteById($id){
		$conn = DBConnect::getConnection();
		$sql = "DELETE FROM contact WHERE hashkey = '$id'";
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
		$key = $this->getKey();
		$output = <<<EOT
<div id='$key' class='contact'>
	<h4 class='contact-subject'>$this->subject</h4>
	<div class='contact-body'>
	<p class='contact-text'>
		$this->message
	</p>
	<span class='contact-name'>$this->name</span>
	<small class='contact-date'>
	$this->date
	</small>
<a href='contact_reply.php?id=$key'>Reply to this query</a>
		<div>
EOT;

			
		return $output;
	}
}
