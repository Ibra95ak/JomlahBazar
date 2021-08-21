<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
require_once '../../../'.DIR_MOD.'Ser_Reachouts.php';
/*Create Users instance*/
$db = new Ser_Users();
$dba = new Ser_Addresses();
$dbr = new Ser_Reachouts();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['stores']=array();
$response['store']=array();
$response['info']=array();
$response['addresses']=array();
$response['reachouts']=array();
$response['categories']=array();
$response['brands']=array();
$response['reachouts']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['storeId'])) $storeId=$_GET['storeId'];
else $storeId=0;
if ($action=='get') {
  if($storeId!=0){
    /*get user store*/
    $store = $db->Admin_getStoreById($storeId);
    if($store){
      $response['err']=0;
      /*get user by Id*/
      $user = $db->Admin_getUserById($store['userId']);
      /*get user addresses*/
      $addresses = $dba->Admin_getUserAddresses($store['userId']);
      if($addresses){
        $response['err']=0;
        foreach ($addresses as $address) {
          array_push($response['addresses'],$address);
        }
      }else {
        $response['addresses']=Null;
      }
      /*get user reachouts*/
      if ($user['reachoutId']!=0) {
        $reachout = $dbr->Admin_getUserReachouts($user['reachoutId']);
        if($reachout){
          $response['err']=0;
          array_push($response['reachouts'],$reachout);
        }else {
          $response['reachouts']=Null;
        }
      }else {
        $response['reachouts']=Null;
      }
      /*get user categories*/
      $categories = $db->getUserCategories($store['userId']);
      if($categories){
        $response['err']=0;
        foreach($categories as $category){
            array_push($response['categories'],$category);
        }
      }else {
        $response['categories'] = Null;
      }
      /*get user brands*/
      $brands = $db->getUserBrands($store['userId']);
      if($brands){
        $response['err']=0;
        foreach($brands as $brand){
            array_push($response['brands'],$brand);
        }
      }else {
        $response['brands'] = Null;
      }
      array_push($response['info'],$user);
      array_push($response['store'],$store);
    }
    echo json_encode($response);
  }else{
    /*get all stores*/
    $stores = $db->Admin_getallStores();
    if($stores){
        foreach($stores as $store){
          $user = $db->getUserById($store['userId']);
          $store['fullname']=$user['fullname'];
          $store['user_pic']=$user['profile_pic'];
          array_push($response['stores'],$store);
        }
    }
    $fp = fopen('../json/stores.json', 'w');
    fwrite($fp, json_encode($response['stores']));
    fclose($fp);
  }

}
?>
