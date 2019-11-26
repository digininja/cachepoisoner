<?php
// var_dump ($_SERVER);

// Tell the cache to cache differently for
// each different user agent string

header ("Vary: User-Agent");

$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
}

function clean_display_string ($str) {
	return htmlentities ($str);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Web Cache Poisoning Lab - Targeted</title>
</head>
<body>
<h1>Targeted Poisoning</h1>
<p>A random number is <?=mt_rand();?>.</p>
<p>Your user agent is: <?=clean_display_string ($_SERVER['HTTP_USER_AGENT'])?></p>
<p>
This page caches different responses based on the provided user agent string. Poison it in a way that only affects users of a specific browser.
</p>
<p>
<img src="http://<?=$host?>/images/poison.png" alt="Bottle of poison" />
</p>
<p><a href="/index.php">Back to home</a></p>
</body>
</html>
