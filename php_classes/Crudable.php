<?php

interface Crudable{
	public function create();
	public static function read($conditions = "", $order = "", $limit = "");
	public function update($field, $value);
	public function delete();
}
