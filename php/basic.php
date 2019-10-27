<?php
$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
}
?>
<meta property="og:image" content="http://<?=$host?>/cms/social.png" />

<?php
//var_dump ($_SERVER);
?>
