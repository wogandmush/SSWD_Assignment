<?php

function noErrors(){
	$answer = true;
	$fields = func_get_args();
	foreach($fields as $field){
		$answer &= (empty($field->getErrors()));
	}
	return $answer;
}

