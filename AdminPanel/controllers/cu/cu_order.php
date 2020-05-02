<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Orders.php';
$db = new Ser_Orders();
$err=-1;

if(isset($_POST['orderId'])) $orderId=$_POST['orderId'];
else $orderId=0;

//get data from form
$userId=$_POST['userId'];
$productId=$_POST['productId'];
$supplierId=$_POST['supplierId'];
$ordernumber=$_POST['ordernumber'];
$puchaseId=$_POST['puchaseId'];
$order_date=$_POST['order_date'];
$statusId=$_POST['statusId'];
$blockId=$_POST['blockId'];
$active=$_POST['active'];

if($orderId>0){
    //Edit order
    $edit_order=$db->editOrder($orderId,$ordernumber,$order_date,$active);
    if($edit_order) $err=0;
    else $err=1;
}else{
    //add order
    $add_order=$db->addOrder($userId,$productId,$supplierId,$ordernumber,$puchaseId,$order_date,
    $statusId,$blockId,$active);
    if($add_order) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>