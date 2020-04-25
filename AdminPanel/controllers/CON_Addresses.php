<?php
//Get base class
require_once '../libraries/Base.php';
//Get address class
require_once '../libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
//results array
$results=array();
//get all leads details
$getAll_addresses = $db->GetAddresses();
foreach($getAll_addresses as $address){
    array_push($results,$address);
}

$fp = fopen('json/addresses.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>