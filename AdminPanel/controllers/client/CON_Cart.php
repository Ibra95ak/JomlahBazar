<?php
/*get base class*/
require_once '../../libraries/base.php';
/*get carts class*/
require_once '../../libraries/Ser_Carts.php';
/*get cart instance*/
$db = new Ser_Carts();
/*results array*/
$results=array();
/*parameters*/
$userId=$_GET['userId'];
/*get user cart*/
$getuser_cart = $db->GetCartByUserId($userId);
if($getuser_cart){
    foreach($getuser_cart as $cart){
        array_push($results,$cart);
    }
}
echo json_encode($results);
?>
