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
		"<div class='jumbotron testimonial mx-auto'>
			<blockquote>$this->message</blockquote>
			<p class='lead'>- $this->name ($this->class)</p>
			<small>$this->date</small>
		</div>";
		return $output;
	}
}
