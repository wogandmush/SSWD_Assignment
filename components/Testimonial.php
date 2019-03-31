<?php

class Testimonial {
	private $name;
	private $date;
	private $message;
	private $class;
	public function __construct($name, $message, $class, $date){
		$this->name = $name;
		$this->message = $message;
		$this->class = $class;
		$this->date = $date;
	}
	public function render(){
		echo $this->getHTMLString();
	}
	public function getHTMLString(){
		$output = 
		"<div class='testimonial'
			<h1>$this->name</h1>
			<p>$this->message</p>
			<small>$this-date</small>
		</div>";
	}
}
