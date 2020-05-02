<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
$err=-1;

if(isset($_POST['orderdetailId'])) $orderdetailId=$_POST['orderdetailId'];
else $orderdetailId=0;

//get data from form
$orderId=$_POST['userId'];
$ordernumber=$_POST['ordernumber'];
$discount=$_POST['discount'];
$totalprice=$_POST['totalprice'];
$productdetailsId=$_POST['productdetailsId'];
$shipperId=$_POST['shipperId'];
$ship_date=$_POST['ship_date'];
$statusId=$_POST['statusId'];
$blockId=$_POST['blockId'];
$active=$_POST['active'];

if($orderdetailId>0){
    //Edit orderdetail
    $edit_orderdetail=$db->editOrderdetail($orderdetailId,$ordernumber,$discount,$totalprice,$ship_date,$active);
    if($edit_orderdetail) $err=0;
    else $err=1;
}else{
    //add orderdetail
    $add_orderdetail=$db->addOrderdetail($orderId,$ordernumber,$discount,$totalprice,$productdetailsId,
    $shipperId,$ship_date,$statusId,$blockId,$active) ;
    if($add_orderdetail) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>