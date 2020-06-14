<?php
/*Call Products class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Get productId*/
$productId=$_GET['productId'];
/*Fetch featured products*/
$featured_pic = $db->GetProductPictures($productId);
if($featured_pic){
    foreach($featured_pic as $pic){
        array_push($results,$pic);
    }   
}   
echo json_encode($results);
?>