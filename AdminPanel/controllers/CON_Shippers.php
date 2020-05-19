<?php
//Get base class
require_once '../libraries/base.php';
//Get shipper class
require_once '../libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
//results array
$results=array();
//get all leads details
$getAll_shippers = $db->GetShippers();
if($getAll_shippers){
    foreach($getAll_shippers as $shipper){
        array_push($results,$shipper);
    }
}
//fill result in json file
$fp = fopen('json/shippers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>