<?php
// var_dump ($_SERVER);

// Tell the cache to cache differently for
// each different user agent string

header ("Vary: User-Agent");

$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
    $forwarded = explode (",", $_SERVER['HTTP_X_FORWARDED_HOST']);
    if (is_array ($forwarded)) {
        $host = array_shift ($forwarded);
    } else {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }   
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Targeted - Cache Poisoning Lab</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
</head>
<body>
	<h1>Targeted Poisoning</h1>
	<p>A random number is <?=mt_rand();?>.</p>
	<p>
		This page caches different responses based on the provided user agent string. Poison it in a way that only affects users of a specific browser.
	</p>
	<p>Your user agent is: <strong><?=htmlentities ($_SERVER['HTTP_USER_AGENT'])?></strong></p>
	<p>
		<img src="https://<?=$host?>/images/poison.png" alt="Bottle of poison" />
	</p>
	<p><a href="/index.php">&laquo; Back to home</a></p>
	<hr />
	<p>
		Lab created by Robin Wood - <a href="https://digi.ninja">DigiNinja</a>
	</p>
</body>
</html>
