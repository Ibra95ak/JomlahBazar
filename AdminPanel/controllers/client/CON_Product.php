<?php
/*Get product class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Parameters*/
$productId = $_GET['productId'];
/*get product */
$get_product = $db->GetproductById($productId);
if($get_product){
    foreach($get_product as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>