<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call orderdetails class*/
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create orderdetails instance*/
$db = new Ser_Orderdetails();
/*Create users instance*/
$dbu = new Ser_Users();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['orderdetails']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['orderId'])) $orderId=$_GET['orderId'];
else $orderId=0;
if ($action=='get') {
  if($orderId!=0){
    /*get order by Id*/
    $order = $db->Admin_getOrderdetailsById($orderId);
    if($order){
      $response['err']=0;
      array_push($response['info'],$order);
    }
  }else{
    /*get all orderdetails*/
    $orderdetails = $db->Admin_getallorderdetails();
    if($orderdetails){
        foreach($orderdetails as $order){
          $buyer = $dbu->getUserById($order['supplierId']);
          $order['fullname']=$buyer['fullname'];
          array_push($response['orderdetails'],$order);
        }
    }
    $fp = fopen('../json/orderdetails.json', 'w');
    fwrite($fp, json_encode($response['orderdetails']));
    fclose($fp);
  }

}
if ($action=='delete') {
  /*delete order*/
  $order = $db->DeleteorderById($orderId);
  if ($order) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location: ".DIR_VIEW.DIR_USR."dt_orderdetails.php?err=".$response['err']);
}
if ($action=='verify') {
  $verifiedorderId=$_GET['verifiedorderId'];
  $verifiedbyorderId=$_SESSION['orderId'];
  $work_other=0;
  /*CHeck if already verfied*/
  $verified = $db->isVerifiedByorder($verifiedorderId,$verifiedbyorderId);
  if($verified){
    $verifyorder  = $db->unVerifyorderById($verifiedorderId,$verifiedbyorderId);
    $response['verified']=0;
  }else{
    $verifyorder  = $db->VerifyorderById($verifiedorderId,$verifiedbyorderId,$work_other);
    $response['verified']=1;
  }

  if ($verifyorder) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  echo json_encode($response);
}
?>
