<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Reachouts.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Devices.php';
/*Create Users instance*/
$db = new Ser_Users();
/*Create address instance*/
$dba = new Ser_Addresses();
/*Create reacout instance*/
$dbr = new Ser_Reachouts();
/*Create reacout instance*/
$dbd = new Ser_Devices();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['info']=array();
$response['address']=array();
$response['reachout']=array();
$response['devices']=array();
$response['contactlist']=array();
$response['company']=array();
$response['categories']=array();
$response['brands']=array();
$response['suppliers']=array();
$arr_cat=array();
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  $userId=$_GET['userId'];
  /*get user by Id*/
  $user = $db->getUserById($userId);
  if($user){
    $response['err']=0;
    array_push($response['info'],$user);
  }else {
    $response['info'] = Null;
  }
  /*get user address*/
  $address = $dba->getAllAddressesByUserId($userId);
  if($address){
    $response['err']=0;
    array_push($response['address'],$address);
  }else {
    $response['address'] = Null;
  }
  /*get user reachout*/
  $reachout = $dbr->GetReachoutByUserId($userId);
  if($reachout){
    $response['err']=0;
    array_push($response['reachout'],$reachout);
  }else {
    $response['reachout'] = Null;
  }
  /*get user devices*/
  $devices = $dbd->GetDevicesByUserId($userId);
  if($devices){
    $response['err']=0;
    foreach($devices as $device){
        array_push($response['devices'],$device);
    }
  }else {
    $response['devices'] = Null;
  }
  /*get user contactlist*/
  $contactlist = $db->getUserContactList($userId);
  if($contactlist){
    $response['err']=0;
    foreach($contactlist as $contact){
        array_push($response['contactlist'],$contact);
    }
  }else {
    $response['contactlist'] = Null;
  }
  /*get user company*/
  $company = $db->getUserCompany($user['usercompanyId']);
  if($company){
    $response['err']=0;
    array_push($response['company'],$company);
  }else {
    $response['company'] = Null;
  }
  /*get user categories*/
  $categories = $db->getUserCategories($userId);
  if($categories){
    $response['err']=0;
    foreach($categories as $category){
        array_push($response['categories'],$category);
        array_push($arr_cat,$category['categoryId']);
    }
  }else {
    $arr_cat = Null;
  }
  /*get user brands*/
  $brands = $db->getUserBrands($userId);
  if($brands){
    $response['err']=0;
    foreach($brands as $brand){
        array_push($response['brands'],$brand);
    }
  }else {
    $response['brands'] = Null;
  }
  if($arr_cat!=Null){
    $cat=implode(",",$arr_cat);
    /*get suppliers by category*/
    $suppliers = $db->GetsuppliersBycategories($cat,$userId);
    if($suppliers){
      $response['err']=0;
      foreach($suppliers as $supplier){
          array_push($response['suppliers'],$supplier);
      }
    }else {
      $response['suppliers'] = Null;
    }
  }
  echo json_encode($response);
}
if ($action=='post') {
  $userId=$_POST['userId'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $otp=$_POST['otp'];
  $reachoutId=$_POST['reachoutId'];
  $phone=$_POST['phone'];
  $whatsapp=$_POST['whatsapp'];
  $telegram=$_POST['telegram'];
  $messenger=$_POST['messenger'];
  $linkedin=$_POST['linkedin'];
  $sms=$_POST['sms'];
  $facebook=$_POST['facebook'];
  $instagram=$_POST['instagram'];
  $teams=$_POST['teams'];
  $zoom=$_POST['zoom'];
  if($userId!=0){
    /*edit user info*/
    $user = $db->EditUser($userId,$fullname, $email, $otp);
    if($user) $response['err']=0;
    else $response['err']=1;
    /*edit user reachout*/
    $reachout = $dbr->editReachout($reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms, $facebook, $instagram, $teams, $zoom);
    if($reachout) $response['err']=0;
    else $response['err']=1;
    /*edit user store*/
  }
  echo json_encode($response);
}
?>
