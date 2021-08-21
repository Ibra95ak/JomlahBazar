<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call refunds class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create refunds instance*/
$db = new Ser_Orders();
/*Create users instance*/
$dbu = new Ser_Users();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['banktransfers']=array();
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
    /*get all bank transfers*/
    $banktransfers = $db->Admin_getbanktransfers();
    foreach ($banktransfers as $banktransfer) {
      array_push($response['banktransfers'],$banktransfer);
    }
    echo json_encode($response['banktransfers']);
}
if ($action=='approve') {
  $ordernumber = $_GET['ordernumber'];
  /*approve bank transfer*/
  $banktransfers_buyer = $db->Admin_updatebuyerbanktransfer($ordernumber,"Completed");
  $banktransfers_seller = $db->Admin_updatesellerbanktransfer($ordernumber,"Completed");
  if ($banktransfers_buyer) {
    $response['err']=0;
  }else {
    $response['err']=1;
  }
  if ($banktransfers_seller) {
    $response['err']=0;
  }else {
    $response['err']=2;
  }
  header("Location:".DIR_VIEW.DIR_ADMN."dt_banktransfers.php?err=".$response['err']);
}
if ($action=='decline') {
  $ordernumber = $_GET['ordernumber'];
  /*approve bank transfer*/
  $banktransfers_buyer = $db->Admin_updatebuyerbanktransfer($ordernumber,"Declined");
  $banktransfers_seller = $db->Admin_updatesellerbanktransfer($ordernumber,"Declined");
  if ($banktransfers_buyer) {
    $response['err']=0;
  }else {
    $response['err']=1;
  }
  header("Location:".DIR_VIEW.DIR_ADMN."dt_banktransfers.php?err=".$response['err']);
}
?>
