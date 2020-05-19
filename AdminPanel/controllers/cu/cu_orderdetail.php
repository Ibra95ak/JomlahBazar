<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
$err=-1;

if(isset($_POST['orderdetailId'])) $orderdetailId=$_POST['orderdetailId'];
else $orderdetailId=0;

//get data from form
$orderId=$_POST['orderId'];
$productId=$_POST['productId'];
$ordernumber=$_POST['ordernumber'];
$discount=$_POST['discount'];
$totalprice=$_POST['totalprice'];
$shipperId=$_POST['shipperId'];
$statusId=$_POST['statusId'];
$blockId=$_POST['blockId'];
if(isset($_POST['active'])) $active=1;
else  $active=2;

if($orderdetailId>0){
    //Edit orderdetail
    $edit_orderdetail=$db->editOrderdetail($orderdetailId,$orderId,$productId,$ordernumber,$discount,$totalprice,$shipperId,$statusId,$blockId,$active);
    if($edit_orderdetail) $err=0;
    else $err=1;
}else{
    //add orderdetail
    $add_orderdetail=$db->addOrderdetail($orderId,$productId,$ordernumber,$discount,$totalprice,$shipperId,$statusId,$blockId,$active) ;
    if($add_orderdetail) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>