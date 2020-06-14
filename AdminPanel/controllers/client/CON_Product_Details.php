<?php
/*Get product details class*/
require_once '../../libraries/Ser_Productdetails.php';
/*Create Product details Instance*/
$db = new Ser_Productdetails();
/*results array*/
$results=array();
/*Parameters*/
$productId = $_GET['productId'];
/*get product */
$get_product = $db->GetproductdetailById($productId);
if($get_product){
    foreach($get_product as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>