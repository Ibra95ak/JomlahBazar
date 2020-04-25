<?php
//Get base class
require_once '../libraries/Base.php';
//Get shipperdetail class
require_once '../libraries/Ser_Shipperdetails.php';
$db = new Ser_Shipperdetails();
//results array
$results=array();
//get all leads details
$getAll_shipperdetails = $db->GetShipperdetails();
foreach($getAll_shipperdetails as $shipperdetail){
    array_push($results,$shipperdetail);
}

$fp = fopen('json/shipperdetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>