<?php
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
	<title>Basic - Cache Poisoning Lab</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	<meta property="og:title" content="Basic Poisoning Lab" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="http://<?=$host?>/cms/social.png" />
</head>
<body>
	<h1>Basic Poisoning Lab</h1>
	<p>A random number is: <?=mt_rand();?></p>
	<p>
		This page loads its open graph image based on the host requested but isn't that clever when working out the host to use.
	</p>
	<p>
		Use this weakness to poison every visitor with a nice bit of Cross-Site Scripting.
	</p>
	<p><a href="/index.php">&laquo; Back to home</a></p>
</body>
</html>
