<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Orders.php';
$db = new Ser_Orders();
$err=-1;

if(isset($_POST['orderId'])) $orderId=$_POST['orderId'];
else $orderId=0;

//get data from form
$userId=$_POST['userId'];
$ordernumber=$_POST['ordernumber'];
$purchaseId=$_POST['purchaseId'];
$statusId=$_POST['statusId'];
$blockId=$_POST['blockId'];
if(isset($_POST['active'])) $active=1;
else $active=2;

if($orderId>0){
    //Edit order
    $edit_order=$db->editOrder($orderId,$userId,$ordernumber,$purchaseId,$statusId,$blockId,$active);
    if($edit_order) $err=0;
    else $err=1;
}else{
    //add order
    $add_order=$db->addOrder($userId,$ordernumber,$purchaseId,$statusId,$blockId,$active);
    if($add_order) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>