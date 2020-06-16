<?php
header("Access-Control-Allow-Origin: *");
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
//Get orders class
require_once '../../libraries/Ser_Orders.php';
$db1 = new Ser_Orders();
//Get orders class
require_once '../../libraries/Ser_Orderdetails.php';
$db2 = new Ser_Orderdetails();
//Get orders class
require_once '../../libraries/Ser_Products.php';
$db3 = new Ser_Products();
//results array
$results=array();
/*parameters*/
$userId=$_GET['userId'];
$productId=$_GET['productId'];
$get_product = $db3->GetproductById($productId);
$quantity=$_GET['quantity'];
//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$characters = '0123456789';
$length=10;
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
$ordernumber=$randomString;
$purchaseId="0";
$statusId="1";
$blockId="1";
$active="1";
$discount="1";
$totalprice=$get_product['unitprice']*$quantity;
$shipperId="1";
/*error flag*/
$err=-1;

/*Check if prodect already exist*/
if($db->isExist_Cart($userId,$productId)) $err=1;
else{

    $count=$db->GetCartCount($userId);

    if($count['countc']==NULL){
      $add_order = $db1->addOrder($userId,$ordernumber,$purchaseId,$statusId,$blockId,$active);
      $orderId=$add_order['insertId'];
    }
    else{
      $get_order = $db1->GetOrderByUserId($userId);
      $orderId=$get_order['orderId'];
      $ordernumber=$get_order['ordernumber'];
    }
    //add to cart
    $add_cart = $db->addCart($userId,$productId,1);
    $add_orderdetails = $db2->addOrderdetail($orderId,$productId,$ordernumber,$discount,$quantity,$totalprice,$shipperId,$statusId,$blockId,$active);
    if($add_cart) $err=0;
    else $err=2;
    if($add_orderdetails) $err=0;
    else $err=2;
}
echo json_encode($err);
?>
