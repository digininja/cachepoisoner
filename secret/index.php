<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="https://digi.ninja/favicon.ico" /> 
	<link rel="apple-touch-icon" href="https://digi.ninja/apple-touch-icon.png" />
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />

	<meta name="Author" content="Robin Wood - DigiNinja" />
	<link rel="alternate" type="application/rss+xml" title="Latest Updates" href="https://digi.ninja/rss.xml" />
	<meta name="twitter:site" content="@digininja" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="manifest" href="https://digi.ninja/manifest.json" />
	<title>Secret Internal Domain - DigiNinja</title>
</head>
<body>
	<h1>Web Cache Poisoning - Secret Site</h1>
	<?php
	if (array_key_exists ("HTTP_X_HOST", $_SERVER)) {
		?>
		<p>Well done, you have accessed the secret internal domain, this page is hosted on secret.digi.ninja and not on the original domain of <?=htmlentities ($_SERVER['HTTP_X_HOST'])?>.</p>
		<p>Return to the <a href="https://poison.digi.ninja">lab</a>.</p>
		<?php
	} else {
		?>
		<p>This page is designed to work with my <a href="https://poison.digi.ninja">Web Cache Poisoning Lab</a>.</p>
		<?php
	}
	?>
</body>
</html>
