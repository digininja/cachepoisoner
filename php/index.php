<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Web Cache Poisoning Lab</title>
</head>
<body>
<h1>Web Cache Poisoning Lab</h1>
<p>
Welcome...
</p>
<h2>Basic</h2>
<p>
A basic poison through the <code>X-Forwarded-Host</code> affecting everyone.
</p>
<p><a href="/basic.php">Go to lab</a></p>
<h2>User Agent</h2>
<p>
Poison a specific user agent. To test this, use two different browsers or a user agent switcher, to see how the poisoning affects one and not the other.
</p>
<p><a href="/ua.php">Go to lab</a></p>
<h2>Redirects</h2>
<p>
Use a bug in internal redirection to bounce everyone who tries to access the page to one you control.
</p>
<p>
From my testing, I was not able to get PHP and Varnish to work together to cache a 301 or 302 redirect, so this exercise uses a meta redirect.
<p><a href="/ua.php">Go to exercise</a></p>
<h2>Timing</h2>
<p>
Use a bug in internal redirection to bounce everyone who tries to access the page to one you control.
</p>
<p>
All the other exercises give the <code>Age</code> header so you know how long you have to wait for the current cache entry to expire so you can launch your attack. This exercise hides the value so you have to derive it for yourself. The value is between 10 and 30 seconds and you do not need to DoS the server to work it out.
<p><a href="/timing.php">Go to exercise</a></p>
</body>
</html>
