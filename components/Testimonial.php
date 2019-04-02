<?php

class Testimonial {
	private $name;
	private $message;
	private $class;
	private $date;
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
		"<div class='jumbotron testimonial'>
			<h1 class='display-3'>$this->name</h1>
			<h4>$this->class</h4>
			<p class='lead'>$this->message</p>
			<small>$this->date</small>
		</div>";
		return $output;
	}
}
