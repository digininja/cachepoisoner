<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Routing - Cache Poisoning Lab</title>
</head>
<body>
	<h1>Routing Poisoning Lab</h1>
	<p>A random number is: <?=mt_rand();?></p>
	<p>
		This page server also hosts the site "digi.ninja".
	</p>
	<p>
		Manipulate the forwarding requests to poison routing to send visitors to my main site instead of this one or to access the secret content.
	</p>
	<p>
		As a bonus, the proxy is mis-configured, and can also be used to access, but not cache, a special "secret" internal site.
	</p>
	<p>
		<a href="/index.php">&laquo; Back</a>
	</p>
</body>
</html>
