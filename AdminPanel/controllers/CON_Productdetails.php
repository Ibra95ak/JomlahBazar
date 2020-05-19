<?php
//Get base class
require_once '../libraries/base.php';
//Get productdetail class
require_once '../libraries/Ser_Productdetails.php';
$db = new Ser_Productdetails();
//results array
$results=array();
//get all leads details
$getAll_productdetails = $db->GetProductdetails();
if($getAll_productdetails){
    foreach($getAll_productdetails as $productdetail){
        array_push($results,$productdetail);
    }   
}
//fill result in json file
$fp = fopen('json/productdetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>