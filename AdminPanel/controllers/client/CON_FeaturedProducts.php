<?php
/*Call products class*/
require_once '../../libraries/Ser_Products.php';
/*create product instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Fetch featured products*/
$featured_products = $db->GetFeaturedProducts();
if($featured_products){
  foreach($featured_products as $product){
    array_push($results,$product);
  }
}
echo json_encode($results);
?>
