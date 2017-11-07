<?php
$myfile = fopen("/home/admuao/params/params.txt", "w") or die("Unable to open file!");
$params = array('token'=>'3242');
$serialize_params = serialize($params);
fwrite($myfile, $serialize_params);
fclose($myfile);
?>
