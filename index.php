<?php
require_once 'Chopper.php';

$chopperObj = new Chopper;
$haystack = array(1,2,7,15,17,23,30,33,34,35,36,40,44,49,50,55,60,66,67,68,90,100,111,112,113,114);

var_dump($chopperObj->chopSlice(2, $haystack));


?>
