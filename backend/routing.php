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
	<title>Routing - Cache Poisoning Lab</title>
</head>
<body>
	<h1>Routing Poisoning Lab</h1>
	<p>A random number is: <?=mt_rand();?></p>
	<p>
		This page server also hosts the site "digi.ninja" and a special "secret" internal site.
	</p>
	<p>
		Manipulate the forwarding requests to poison routing to send visitors to my main site instead of this one or to access the secret content.
	</p>
	<p>
		<a href="/index.php">&laquo; Back</a>
	</p>
</body>
</html>
