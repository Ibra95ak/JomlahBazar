<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*require addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*create addresses instance*/
$db = new Ser_Addresses();
/*response Array*/
$response=array();
/*error flag*/
$response['err']=-1;
$response['addresses']=array();
$response['useraddress']=array();
$response['selleraddress']=array();
/*url parameters*/
$action=$_GET['action'];
if (isset($_GET['addressId'])) $addressId = $_GET['addressId'];
else $addressId = 0;
if (isset($_GET['userId'])) $userId = $_GET['userId'];
else $userId = 0;
if (isset($_GET['sellerId'])) $sellerId = $_GET['sellerId'];
else $sellerId = 0;
if ($action=='get') {
  if($addressId==0){
    /*get all addresses*/
    $addresses = $db->GetAddressesUsers();
    array_push($response['addresses'],$addresses);
    $response['err']=0;
  }else {
    $addresses = $db->getUserAddressById($addressId,$userId);
    array_push($response['useraddress'],$addresses);
    $response['err']=0;
  }
  if ($sellerId!=0) {
    $addresses = $db->getDefaultAddressByUserId($sellerId);
    array_push($response['selleraddress'],$addresses);
    $response['err']=0;
  }
}
if ($action=="delete") {
  $addresses = $db->DeleteUserAddressbyId($addressId,$userId);
}
if ($action=="delete-checkout") {
  $addresses = $db->DeleteUserAddressbyId($addressId,$userId);
}
echo json_encode($response);
?>
