<?php
header ("Vary: X-Special-Ignored");

print "Hello world from Cache project\n";

if (isset ($_SERVER['HTTP_X_SPECIAL_WATCHED'])) {
	print "The special parameter is:\n";
	var_dump ($_SERVER['HTTP_X_SPECIAL_WATCHED']);
}

if (isset ($_SERVER['HTTP_X_SPECIAL_IGNORED'])) {
	print "The special parameter is:\n";
	var_dump ($_SERVER['HTTP_X_SPECIAL_IGNORED']);
}
//var_dump ($_SERVER);
?>

<a href="https://www.varnish-software.com/wiki/content/tutorials/varnish/varnish_ubuntu.html">Varnish tutorial</a><br />

<a href="https://portswigger.net/blog/practical-web-cache-poisoning">Burp blog post</a><br />
