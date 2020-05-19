<?php
//Get base class
require_once '../libraries/base.php';
//Get product class
require_once '../libraries/Ser_Products.php';
$db = new Ser_Products();
//results array
$results=array();
$supplierId=$_GET['supplierId'];
$cartId=$_GET['cartId'];
if($supplierId>0){
    //get all products for supplier
    $getAll_products = $db->GetSupplierProducts($supplierId);
}else if($cartId>0){
    $getAll_products = $db->GetCartProducts($cartId);
} else {
    //get all products 
    $getAll_products = $db->GetProducts();
}
if($getAll_products){
    foreach($getAll_products as $product){
        array_push($results,$product);
    }   
}
//fill result in json file
$fp = fopen('json/products.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>