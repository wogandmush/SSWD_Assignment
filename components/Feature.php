<?php
class Feature {
	private $id;
	private $title;
	private $detail;
	private $image_url;
	private $link;
	public function __construct($id, $title, $detail, $image_url, $link){
		$this->id = $id;
		$this->title = $title;
		$this->detail = $detail;
		$this->image_url = $image_url;
		$this->link = $link;
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
