<?php
//Get base class
require_once '../../libraries/base.php';
//Get shipperdetail class
require_once '../../libraries/Ser_Shipperdetails.php';
$db = new Ser_Shipperdetails();
$err=-1;
//delete shipperdetail
if(isset($_GET['shipperdetailId'])){
    $del_shipperdetails = $db->DeleteShipperdetailById($_GET['shipperdetailId']);
}
if($del_shipperdetails){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_shipperdetails.php?err=$err");
exit;
?>