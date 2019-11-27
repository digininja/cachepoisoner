<?php
// var_dump ($_SERVER);

$redirect = "https://digi.ninja";

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
	$redirect = "https://" . $_SERVER['HTTP_X_FORWARDED_HOST'];
}

function clean_display_string ($str) {
	return htmlentities ($str);
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">    
<head>      
<title>The Tudors</title>      
<meta http-equiv="refresh" content="0;URL='<?=clean_display_string ($redirect)?>'" />    
</head>    
<body> 
<h1>Redirection Poisoning</h1>
<p>A random number is: <?=mt_rand();?></p>
<p>This page has moved to a <a href="<?=clean_display_string ($redirect)?>">
<?=clean_display_string ($redirect)?></a>.</p> 
<img src="/images/poison.png" alt="Bottle of poison" />
</body>  
</html>     
