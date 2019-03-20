<?php
include '../header.php';

$test = new Input('name', 'Name: ', 'text');
$test->render();
$test->setData("';Hi there'");

include '../../config/connect.php';
echo "<p>".$test->getData()."</p>";
echo "<p>".$test->getData($conn)."</p>";

