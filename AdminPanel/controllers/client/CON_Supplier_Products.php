<?php
/*Get product class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Parameters*/
$supplierId=$_GET['supplierId'];
/*get all supplier products */
$getAll_products = $db->GetSupplierProducts($supplierId);
if($getAll_products){
    foreach($getAll_products as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>