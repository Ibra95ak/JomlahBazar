<?php
//Get base class
require_once '../libraries/base.php';
//Get address class
require_once '../libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
//results array
$results=array();
//get all leads details
$getAll_addresses = $db->GetAddresses();
if($getAll_addresses){
    foreach($getAll_addresses as $address){
        array_push($results,$address);
    }   
}
//fill result in json array
$fp = fopen('json/addresses.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>