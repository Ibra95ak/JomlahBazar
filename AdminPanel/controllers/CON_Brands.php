<?php
//Get base class
require_once '../libraries/Base.php';
//Get brand class
require_once '../libraries/Ser_Brands.php';
$db = new Ser_Brands();
//results array
$results=array();
//get all leads details
$getAll_brands = $db->GetBrands();
foreach($getAll_brands as $brand){
    array_push($results,$brand);
}

$fp = fopen('json/brands.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>