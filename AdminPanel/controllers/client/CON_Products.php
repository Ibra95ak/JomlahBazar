<?php
//Get base class
require_once '../../libraries/base.php';
//Get product class
require_once '../../libraries/Ser_Products.php';
$db = new Ser_Products();
//results array
$results=array();
 //get all products 
    $getAll_products = $db->GetProducts();
if($getAll_products){
    foreach($getAll_products as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>