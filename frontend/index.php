<?php
$rand = substr (md5(time() . mt_rand()), 0, 8);
$host = "http://" . $rand . ".poison.digi.ninja:81";
$host = "http://" . $rand . ".poison.test:81";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Web Cache Poisoning Lab</title>
</head>
<body>
	<h1>Web Cache Poisoning Lab</h1>
	<p>
		Welcome to the Cache Poisoning Lab. In this lab you will have the opportunity to experiment with some of the vulnerabilities presented in the brilliant paper <a href="https://portswigger.net/research/practical-web-cache-poisoning">Practical Web Cache Poisoning</a> by <a href="https://twitter.com/albinowax">James Kettle</a>.
	</p>
	<p>
		I'll give a few pointers in the various labs, but not too much as James has given a good walk through of exploiting each issue in his post.
	</p>
	<p>
		To prevent people interfering with each other as they run their tests, everyone gets their own host to work on. For this session, your host will be <strong><?=$host?></strong>, but this will change whenever you refresh this page.
	</p>
	<h2>Basic</h2>
	<p>
		A basic poison, affecting everyone, through the host name.
	</p>
	<p><a href="<?=$host?>/basic.php">Go to lab</a></p>
	<h2>Selective Poisoning</h2>
	<p>
		Poison a specific user agent. To test this, use two different browsers or a user agent switcher, to see how the poisoning affects one and not the other.
	</p>
	<p><a href="<?=$host?>/ua.php">Go to lab</a></p>
	<h2>Redirects</h2>
	<p>
		Use a bug in internal redirection to bounce everyone who tries to access the page to one you control.
	</p>
	<p>
		From my testing, I was not able to get PHP and Varnish to work together to cache a 301 or 302 redirect, so this exercise uses a meta redirect.
	</p>
	<p><a href="<?=$host?>/redirect.php">Go to exercise</a></p>
	<h2>Timing</h2>
	<p>
		All the other exercises give the <code>Age</code> header so you know how long you have to wait for the current cache entry to expire so you can launch your attack. This exercise hides the value so you have to derive it for yourself. The value is between 10 and 30 seconds and you do not need to DoS the server to work it out.
	<p><a href="<?=$host?>/timing.php">Go to exercise</a></p>
</body>
</html>
