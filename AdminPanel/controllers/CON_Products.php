<?php
//Get base class
require_once '../libraries/Base.php';
//Get product class
require_once '../libraries/Ser_Products.php';
$db = new Ser_Products();
//results array
$results=array();
//get all leads details
$getAll_products = $db->GetProducts();
foreach($getAll_products as $product){
    array_push($results,$product);
}

$fp = fopen('json/products.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>