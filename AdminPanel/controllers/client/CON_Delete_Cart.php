<?php
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
//results array
$results=array();
$err=-1;
/*parameters*/
$cartId=$_GET['cartId'];
//get all leads details
$delete_cart = $db->DeleteCartById($cartId);
if($delete_cart) $err=0;
else $err=1;
echo json_encode($err);
?>