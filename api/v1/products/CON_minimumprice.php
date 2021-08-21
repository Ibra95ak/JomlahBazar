<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*response array*/
$response['products']=array();
$response['count']=array();
/*get all products */
$productIds = $db->GetAllProductIds();
if ($productIds) {
    foreach ($productIds as $productId) {
      $cheapestsupplier = $db->GetCheapestSupplier($productId['productId']);
      $update_price = $db->editProductminprice($productId['productId'],$cheapestsupplier['price2']);
    }
}
?>
