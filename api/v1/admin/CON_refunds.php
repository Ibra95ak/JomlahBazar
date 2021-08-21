<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call refunds class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call refunddetails class*/
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
/*Create refunds instance*/
$db = new Ser_Orders();
/*Create users instance*/
$dbu = new Ser_Users();
/*Create addresses instance*/
$dba = new Ser_Addresses();
/*Create refunddetails instance*/
$dbod = new Ser_Orderdetails();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['refunds']=array();
$response['refund']=array();
$response['buyer']=array();
$response['seller']=array();
$response['products_sellers']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['refundId'])) $refundId=$_GET['refundId'];
else $refundId=0;
if ($action=='get') {
    /*get all refunds*/
    $refunds = $dbod->Admin_getallrefunds();
    if($refunds){
        foreach($refunds as $refund){
          $order_info = $db->GetOrderByOrderDetailId($refund['orderdetailId']);
          $refund['ordernumber']=$order_info['ordernumber'];
          $orderdetails = $dbod->GetOrderdetailById($refund['orderdetailId']);
          $refund['quantity_refunded']=$orderdetails['quantity'];
          $refund['refund_price']=$orderdetails['totalprice'];
          $refund['quantity_refunded']=$orderdetails['quantity'];
          $buyer = $dbu->getUserById($refund['userId']);
          $refund['buyer']=$buyer['fullname'];
          $seller_info = $dbu->getUserById($order_info['sellerId']);
          $seller = $dbu->getUserCompany($seller_info['usercompanyId']);
          $refund['seller']=$seller['companyname'];
          array_push($response['refunds'],$refund);
        }
    }
    echo json_encode($response['refunds']);
}
if ($action=='approve') {
  $refundId = $_GET['refundId'];
  /*approve bank transfer*/
  $refunds = $db->Admin_updaterefund($refundId,6);
  if ($refunds) {
    $response['err']=0;
  }else {
    $response['err']=1;
  }
  header("Location:".DIR_VIEW.DIR_ADMN."dt_refunds.php?err=".$response['err']);
}
if ($action=='decline') {
  $refundId = $_GET['refundId'];
  /*approve bank transfer*/
  $refunds = $db->Admin_updaterefund($refundId,7);
  if ($refunds) {
    $response['err']=0;
  }else {
    $response['err']=1;
  }
  header("Location:".DIR_VIEW.DIR_ADMN."dt_refunds.php?err=".$response['err']);
}
?>
