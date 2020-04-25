<?php
//Get base class
require_once '../libraries/Base.php';
//Get productdetail class
require_once '../libraries/Ser_Productdetails.php';
$db = new Ser_Productdetails();
//results array
$results=array();
//get all leads details
$getAll_productdetails = $db->GetProductdetails();
foreach($getAll_productdetails as $productdetail){
    array_push($results,$productdetail);
}

$fp = fopen('json/productdetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>