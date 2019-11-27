<?php
// var_dump ($_SERVER);

// Tell the cache to cache differently for
// each different user agent string

header ("Vary: User-Agent");

$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
    $forwarded = explode (",", $_SERVER['HTTP_X_FORWARDED_HOST']);
    if (is_array ($forwarded)) {
        $host = array_shift ($forwarded);
    } else {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }   
}

if (array_key_exists ("HTTP_USER_AGENT", $_SERVER) && strpos (strtolower ($_SERVER['HTTP_USER_AGENT']), "chrome") !== false) {
	$redirect = "http://" . $host . "/chrome.php";
} else {
	$redirect = "http://" . $host . "/others.php";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">    
<head>      
<title>The Tudors</title>      
<meta http-equiv="xrefresh" content="4;URL='<?=htmlentities ($redirect)?>'" />    
</head>    
<body> 
<h1>Redirection Poisoning</h1>
<p>A random number is: <?=mt_rand();?></p>
<p>This page has moved to a <a href="<?=htmlentities ($redirect)?>">
<?=htmlentities ($redirect)?></a>.</p> 
<img src="/images/poison.png" alt="Bottle of poison" />
</body>  
</html>     
