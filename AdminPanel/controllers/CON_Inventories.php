<?php
//Get base class
require_once '../libraries/Base.php';
//Get inventory class
require_once '../libraries/Ser_Inventories.php';
$db = new Ser_Inventories();
//results array
$results=array();
//get all leads details
$getAll_inventories = $db->GetInventories();
foreach($getAll_inventories as $inventory){
    array_push($results,$inventory);
}

$fp = fopen('json/inventories.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>