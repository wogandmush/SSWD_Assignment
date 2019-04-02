<?php

$filename = "text.txt";
if(touch($filename)){
	chmod($filename, 0666);
	$handler = fopen($filename, "w");
	$content = "The heart of darkness";
	fwrite($handler, $content);
	fclose($handler);
}
else {
echo "failed";
}
