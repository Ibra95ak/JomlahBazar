<?php
//Get base class
require_once '../libraries/Base.php';
//Get AAA class
require_once '../libraries/Ser_AAA.php';
$db = new Ser_AAA();
//results array
$results=array();
//get all leads details
$getAll_aaa = $db->getAll_aaa();
foreach($getAll_aaa as $aaa){
    array_push($results,$aaa);
}

$fp = fopen('json/aaa.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>