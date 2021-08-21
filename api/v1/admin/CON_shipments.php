<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call shipments class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call shipmentdetails class*/
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
/*Create shipments instance*/
$db = new Ser_Orders();
/*Create users instance*/
$dbu = new Ser_Users();
/*Create addresses instance*/
$dba = new Ser_Addresses();
/*Create shipmentdetails instance*/
$dbod = new Ser_Orderdetails();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['shipments']=array();
$response['shipment']=array();
$response['buyer']=array();
$response['buyer_address']=array();
$response['products_sellers']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['shipmentId'])) $shipmentId=$_GET['shipmentId'];
else $shipmentId=0;
if ($action=='get') {
  if($shipmentId!=0){
    /*get shipment by Id*/
    $shipment = $db->Admin_getshipmentById($shipmentId);
    if($shipment){
      $response['err']=0;
      $buyer = $dbu->Admin_getUserById($shipment['userId']);
      $buyer_address = $dba->Admin_getAddressById($shipment['addressId']);
      $shipmentdetails = $dbod->Admin_getshipmentdetailsById($shipment['shipmentId']);
      foreach ($shipmentdetails as $shipmentdetail) {
        array_push($response['products_sellers'],$shipmentdetail);
      }
      array_push($response['buyer'],$buyer);
      array_push($response['buyer_address'],$buyer_address);
      array_push($response['shipment'],$shipment);
    }
    echo json_encode($response);
  }else{
    /*get all shipments*/
    $shipments = $dbod->Admin_getallshipments();
    if($shipments){
        foreach($shipments as $shipment){
          $orderdtl = $dbod->GetOrderdetailByshipmentId($shipment['shipmentId']);
          $order = $db->GetOrderById($orderdtl['orderId']);
          $destination_address = $dba->getAddressById($order['addressId']);
          $source_address = $dba->getAddressByUserId($orderdtl['supplierId']);
          $shipment['ordernumber']=$orderdtl['ordernumber'];
          $shipment['destination']=$destination_address['address1']." ".$destination_address['city'];
          $shipment['source']=$source_address['address1']." ".$source_address['city'];
          $seller = $dbu->getUserById($orderdtl['supplierId']);
          $shipment['seller']=$seller['fullname'];
          array_push($response['shipments'],$shipment);
        }
    }
    $fp = fopen('../json/shipments.json', 'w');
    fwrite($fp, json_encode($response['shipments']));
    fclose($fp);
  }

}
?>
