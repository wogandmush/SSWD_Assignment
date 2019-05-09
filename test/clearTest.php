<?php

include 'header.php';


$fsRoot = PathHelper::getFSRoot();
echo (IOHelper::clearDirectory("$fsRoot/images/.temp"));

include 'footer.php';
