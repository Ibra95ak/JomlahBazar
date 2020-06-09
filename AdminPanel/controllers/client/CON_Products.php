<?php
/*Get product class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Parameters*/
$search_category=$_GET['search_category'];
$search=$_GET['search'];
/*get all products */
if($search!=NULL) $getAll_products = $db->SearchProducts($search);
else $getAll_products = $db->GetProducts();
if($getAll_products){
    foreach($getAll_products as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>