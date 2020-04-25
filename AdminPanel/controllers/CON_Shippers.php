<?php
//Get base class
require_once '../libraries/Base.php';
//Get shipper class
require_once '../libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
//results array
$results=array();
//get all leads details
$getAll_shippers = $db->GetShippers();
foreach($getAll_shippers as $shipper){
    array_push($results,$shipper);
}

$fp = fopen('json/shippers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>