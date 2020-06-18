<?php
/*call products class*/
require_once '../../libraries/Ser_Products.php';
/*create product instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Fetch latest products*/
$latest_products = $db->GetLatestProducts();
if($latest_products){
    foreach($latest_products as $product){
      array_push($results,$product);
    }
}
echo json_encode($results);
?>
