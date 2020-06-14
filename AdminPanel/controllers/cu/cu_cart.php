<?php
//Get base class
require_once '../../libraries/base.php';
//Get cart class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
$err=-1;
if(isset($_POST['cartId'])) $cartId=$_POST['cartId'];
else $cartId=0;

//get data from form
$userId=$_POST['userId'];
$productId=$_POST['productId'];
if(isset($_POST['active'])) $active=1;
else $active=2;
    
if($cartId>0){
    //Edit cart
    $edit_cart=$db->editCart($cartId,$userId,$productId,$active);
    if($edit_cart) $err=0;
    else $err=1;
}else{
    //add cart
    $add_cart=$db->addCart($userId,$productId,$active);
    if($add_cart) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>