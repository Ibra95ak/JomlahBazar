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
$where="";
if(isset($_GET['min_price']) && isset($_GET['max_price'])){
    if($where=="") $where.="unitprice BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price'];
    else $where.="AND unitprice BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price'];
} 
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