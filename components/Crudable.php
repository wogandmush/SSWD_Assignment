<?php

interface Crudable{
	public function create();
	public static function read($conditions = "", $limit = 100, $order = "");
	public function update($field, $value);
	public function delete();
}
