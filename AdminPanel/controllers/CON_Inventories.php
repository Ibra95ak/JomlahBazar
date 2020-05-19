<?php
//Get base class
require_once '../libraries/base.php';
//Get inventory class
require_once '../libraries/Ser_Inventories.php';
$db = new Ser_Inventories();
//results array
$results=array();
//get all leads details
$getAll_inventories = $db->GetInventories();
if($getAll_inventories){
    foreach($getAll_inventories as $inventory){
        array_push($results,$inventory);
    }
}
//fill result in json file
$fp = fopen('json/inventories.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>