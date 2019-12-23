<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Timing - Cache Poisoning Lab</title>
</head>
<body>
	<h1>Timing Calculator</h1>
	<p>A random number is <?=mt_rand();?>.</p>
	<p>
		Use the random value above to identify when the cache updates so you can estimate the maximum age.
	</p>
	<p>
		The value is between 10 and 30 seconds and can be calculated without hammering the server too hard.
	</p>
	<p><a href="/index.php">&laquo; Back to home</a></p>
</body>
</html>
