<?php
$host = $_SERVER['HTTP_HOST'];

if (array_key_exists ("HTTP_X_FORWARDED_HOST", $_SERVER)) {
    $forwarded = explode (",", $_SERVER['HTTP_X_FORWARDED_HOST']);
    var_dump ($forwarded);
    if (is_array ($forwarded)) {
        $host = array_shift ($forwarded);
    } else {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }   
}

?>
<meta property="og:image" content="http://<?=$host?>/cms/social.png" />

<?php
//var_dump ($_SERVER);
?>
