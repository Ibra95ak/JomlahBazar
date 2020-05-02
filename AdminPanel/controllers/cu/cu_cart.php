<?php
//Get base class
require_once '../../libraries/Base.php';
//Get cart class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
$err=-1;

if(isset($_POST['cartId'])) $cartId=$_POST['cartId'];
else $cartId=0;

//get data from form
$userId=$_POST['userId'];
$productId=$_POST['productId'];
$created_date=$_POST['created_date'];
$updated_date=$_POST['updated_date'];
$active=$_POST['active'];

if($cartId>0){
    //Edit cart
    $edit_cart=$db->editCart($cartId,$userId,$productId,$created_date,$updated_date,$active);
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