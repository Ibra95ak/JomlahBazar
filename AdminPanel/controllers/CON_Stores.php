<?php
//Get base class
require_once '../libraries/base.php';
//Get store class
require_once '../libraries/Ser_Stores.php';
$db = new Ser_Stores();
//results array
$results=array();
//get all leads details
$getAll_stores = $db->Getstores();
if($getAll_stores){
    foreach($getAll_stores as $store){
        array_push($results,$store);
    }
}
//fill result in json file
$fp = fopen('json/stores.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>