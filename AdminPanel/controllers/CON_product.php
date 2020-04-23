<?php
//Get base class
require_once '../libraries/Base.php';
//Get AAA class
require_once '../libraries/DB_AAA.php';
$db = new DB_product();
//results array
$results=array();
//get all leads details
$getAll_product = $db->getAll_product();
foreach($getAll_product as $product){
    array_push($results,$product);
}

$fp = fopen('json/product.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>