<?php
print "Welcome\n";
var_dump ($_SERVER['HTTP_HOST']);
var_dump ($_SERVER['PHP_SELF']);
// This is prevent all caching
// header ("X-No-Cache: 0");
header ("abc:ddd");
?>
A random number is <?=mt_rand();?>

