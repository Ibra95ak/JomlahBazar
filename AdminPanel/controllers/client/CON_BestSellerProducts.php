<?php
/*Call Products class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Fetch best seller products*/
$bestsellers = $db->GetBestSellerProducts();
if($bestsellers){
    foreach($bestsellers as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>