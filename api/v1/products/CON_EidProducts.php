<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*create product instance*/
$db = new Ser_Products();
/*results array*/
$response=array();
/*Fetch eid products*/
$eid_products = $db->GetEidProducts();
if($eid_products){
    foreach($eid_products as $product){
      array_push($response,$product);
    }
}
echo json_encode($response);
?>
