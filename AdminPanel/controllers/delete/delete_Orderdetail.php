<?php
//Get base class
require_once '../../libraries/base.php';
//Get orderdetail class
require_once '../../libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
$err=-1;
//delete orderdetail
if(isset($_GET['orderdetailId'])){
    $del_orderdetails = $db->DeleteOrderdetailById($_GET['orderdetailId']);
}
if($del_orderdetails){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_orderdetails.php?err=$err");
exit;
?>