<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call orders class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call orderdetails class*/
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
/*Create orders instance*/
$db = new Ser_Orders();
/*Create users instance*/
$dbu = new Ser_Users();
/*Create addresses instance*/
$dba = new Ser_Addresses();
/*Create orderdetails instance*/
$dbod = new Ser_Orderdetails();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['orders']=array();
$response['order']=array();
$response['buyer']=array();
$response['buyer_address']=array();
$response['products_sellers']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['orderId'])) $orderId=$_GET['orderId'];
else $orderId=0;
if ($action=='get') {
  if($orderId!=0){
    /*get order by Id*/
    $order = $db->Admin_getOrderById($orderId);
    if($order){
      $response['err']=0;
      $buyer = $dbu->Admin_getUserById($order['userId']);
      $buyer_address = $dba->Admin_getAddressById($order['addressId']);
      $orderdetails = $dbod->Admin_getOrderdetailsById($order['orderId']);
      foreach ($orderdetails as $orderdetail) {
        array_push($response['products_sellers'],$orderdetail);
      }
      array_push($response['buyer'],$buyer);
      array_push($response['buyer_address'],$buyer_address);
      array_push($response['order'],$order);
    }
    echo json_encode($response);
  }else{
    /*get all orders*/
    $orders = $db->Admin_getallOrders();
    if($orders){
        foreach($orders as $order){
          $buyer = $dbu->getUserById($order['userId']);
          $order['fullname']=$buyer['fullname'];
          array_push($response['orders'],$order);
        }
    }
    $fp = fopen('../json/orders.json', 'w');
    fwrite($fp, json_encode($response['orders']));
    fclose($fp);
  }

}
?>
