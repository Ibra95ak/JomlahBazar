<?php
//Get base class
require_once '../libraries/base.php';
//Get brand class
require_once '../libraries/Ser_Brands.php';
$db = new Ser_Brands();
//results array
$results=array();
//get all leads details
$getAll_brands = $db->GetBrands();
if($getAll_brands){
    foreach($getAll_brands as $brand){
        array_push($results,$brand);
    }   
}
//fill result in json file
$fp = fopen('json/brands.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>