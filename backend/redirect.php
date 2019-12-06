<?php
require_once ("useful.inc.php");

# var_dump ($_SERVER);
# var_dump_pre ($_SERVER['HTTP_X_UA_BROWSER']);
# var_dump_pre ($_SERVER['HTTP_X_FORWARDED_HOST']);

// Tell the cache to cache differently for different browser 
// types it detects based on different user agent strings.
header ("Vary: X-UA-BROWSER");

if (array_key_exists ("HTTP_X_UA_BROWSER", $_SERVER) &&
	array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {

	$browser_type = $_SERVER['HTTP_X_UA_BROWSER'];

	if ($browser_type == "chrome") {
		$forwarded = explode (",", $_SERVER['HTTP_X_FORWARDED_HOST']);
		if (is_array ($forwarded)) {
			$host = array_shift ($forwarded);
		} else {
			$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
		}
		$redirect = "http://" . $host . "/chrome.php";
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Redirection - Cache Poisoning Lab</title>
<?php
if (isset ($redirect)) {
	?>
	<meta http-equiv="refresh" content="1;URL='<?=htmlentities ($redirect)?>'" />
	<?php
}
?>
</head>
<body>
	<h1>Redirection Poisoning</h1>
	<p>A random number is: <?=mt_rand();?></p>
	<?php
	if (isset ($redirect)) {
		?>
		<p>We have some special content for Chrome users: <a href="<?=htmlentities ($redirect)?>"><?=htmlentities ($redirect)?></a>.</p>
		<?php
	} else {
		?>
		<p>
			This content is for all non-Chrome users.
		</p>
		<?php
	}
	?>
	<img src="/images/poison.png" alt="Bottle of poison" />
</body>
</html>
