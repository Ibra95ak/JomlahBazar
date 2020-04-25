<?php
//Get base class
require_once '../libraries/Base.php';
//Get store class
require_once '../libraries/Ser_Stores.php';
$db = new Ser_Stores();
//results array
$results=array();
//get all leads details
$getAll_stores = $db->GetStores();
foreach($getAll_stores as $store){
    array_push($results,$store);
}

$fp = fopen('json/stores.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>