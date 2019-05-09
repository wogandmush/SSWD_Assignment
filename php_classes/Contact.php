<?php

class Contact implements Crudable{
	private $name;
	private $email;
	private $subject;
	private $message;
	private $mobile;
	private $hashkey;

	public function __construct($name, $email, $subject, $message, $mobile = "", $hashkey = ""){
		$this->name = $name;
		$this->email = $email;
		$this->subject = $subject;
		$this->message = $message;
		$this->mobile = $mobile;
		$this->hashkey = $hashkey;
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
	public static function read($conditions = "", $order = "", $limit = ""){

	}
	public function update($field, $value){

	}
	public function delete(){

	}
}
