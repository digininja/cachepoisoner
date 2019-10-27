<?php
var_dump ($_SERVER['HTTP_HOST']);
var_dump ($_SERVER['PHP_SELF']);
// var_dump ($_SERVER);
// This is prevent all caching
// header ("X-No-Cache: 0");
header ("Vary: User-Agent");

$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
}

function clean_display_string ($str) {
	return htmlentities ($str);
}

?>
<h1>User Agent Poisoning</h1>

<p>Your user agent is: <?=clean_display_string ($_SERVER['HTTP_USER_AGENT'])?>

<p>A random number is: <?=mt_rand();?></p>

<img src="http://<?=$host?>/poison.png" alt="Bottle of poison" />

