<?php
//Get base class
require_once '../../libraries/Base.php';
//Get order class
require_once '../../libraries/Ser_Orders.php';
$db = new Ser_Orders();
$err=-1;
//delete order
if(isset($_GET['orderId'])){
    $del_orders = $db->DeleteOrderById($_GET['orderId']);
}
if($del_orders){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_orders.php?err=$err");
exit;
?>