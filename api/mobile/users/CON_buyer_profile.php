<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Reachouts.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Devices.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Roles.php';
/*Create Users instance*/
$db = new Ser_Users();
/*Create address instance*/
$dba = new Ser_Addresses();
/*Create reacout instance*/
$dbr = new Ser_Reachouts();
/*Create reacout instance*/
$dbd = new Ser_Devices();
/*Create reacout instance*/
$dbur = new Ser_Roles();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['is_seller']=-1;
$response['adrs']=-1;
$response['cmp']=-1;
$response['ro']=-1;
$response['info']=array();
$response['role']=array();
$response['address']=array();
$response['reachout']=array();
$response['devices']=array();
$response['contactlist']=array();
$response['company']=array();
$response['categories']=array();
$response['brands']=array();
$response['suppliers']=array();
$response['verified']=array();
$response['default_address']=array();
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
  /*get user role*/
  $role = $dbur->getRoleByuserId($userId);
  if($role){
    $response['err']=0;
    array_push($response['role'],$role);
  }else {
    $response['role'] = Null;
  }
  /*get user address*/
  $addresses = $dba->getAllAddressesByUserId($userId);
  if($addresses){
    $response['err']=0;
    foreach($addresses as $address){
        array_push($response['address'],$address);
    }
  }else {
    $response['address'] = Null;
  }
  $response['default_address']= Null;
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
  /*get user verification total*/
  $user = $db->getUserVerifyById($userId);
  if($user){
    $response['err']=0;
    array_push($response['verified'],$user);
  }else {
    $response['info'] = Null;
  }
  echo json_encode($response);
}
if ($action=='post') {
  $userId=$_POST['userId'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $otp=$_POST['otp'];
  $roleId=$_POST['roleId'];
  //$active=$_POST['activate'];
  $ipaddress=$_POST['ipaddress'];
  $address1=$_POST['address1'];
  $address2=$_POST['address2'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $postalcode=$_POST['postalcode'];
  $country=$_POST['country'];
  $latitude=$_POST['latitude'];
  $longitude=$_POST['longitude'];
  $reachoutId=$_POST['reachoutId'];
  $phone=$_POST['phone'];
  $whatsapp=$_POST['whatsapp'];
  $telegram=$_POST['telegram'];
  $messenger=$_POST['messenger'];
  $linkedin=$_POST['linkedin'];
  $sms=$_POST['sms'];

  $companyname=$_POST['companyname'];
  $target_dir = "../../../assets/media/stores/";
  $target_file = $target_dir . basename($_FILES["store_pic"]["name"]);
  $path=substr($target_file, 9);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["store_pic"]["tmp_name"], $target_file)) {
      $response['err']==0;
  } else {
      $response['err']==1;
  }
  $sup_categoriesId=explode(",",$_POST['categoriesId']);
  $sup_brandsId=explode(",",$_POST['brandsId']);

  if($userId!=0){
    /*edit user info*/
    $user = $db->EditUser($userId,$fullname, $email, $otp, $roleId);
    if($user) $response['err']=0;
    else $response['err']=1;
    /*edit user address*/
    $address = $dba->EditUserAddress($userId,$ipaddress, $address1, $address2, $city, $state, $postalcode, $country, $latitude, $longitude);
    if($address) $response['err']=0;
    else $response['err']=1;
    /*edit user reachout*/
    $reachout = $dbr->editReachout($reachoutId, $phone, $whatsapp, $telegram, $messenger, $linkedin, $sms);
    if($reachout) $response['err']=0;
    else $response['err']=1;
    /*edit user store*/
    $user = $db->EditStore($userId,$companyname, $path);
    if($user) $response['err']=0;
    else $response['err']=1;
    $del = $db->DeleteSupplierCategory($userId);
    $del = $db->DeleteSupplierbrand($userId);
    foreach ($sup_categoriesId as $categoryId) {
      $add = $db->addSupplierCategory($userId,$categoryId);
    }
    foreach ($sup_brandsId as $brandId) {
      $add = $db->addSupplierBrand($userId,$brandId);
    }
  }else{

  }
  echo json_encode($response);
}
if ($action=="get-default-address") {
  $userId=$_GET['userId'];
  /*get user address*/
  $address = $dba->getDefaultAddressByUserId($userId);
  if($address){
    $response['err']=0;
    array_push($response['default_address'],$address);
  }else {
    $response['default_address'] = Null;
  }
  echo json_encode($response);
}
if ($action=="checkprofile") {
  $userId = $_GET['userId'];
  if ($userId==0) {
    $response['err'] = 0;
  }else {
    /*get user by Id*/
    $user = $db->getUserById($userId);
    $response['is_seller'] = $user['is_seller'];
    /*get user address*/
    $is_address = $dba->getAllAddressesByUserId($userId);
    if ($is_address){
      $response['adrs'] = 1;
      $response['err'] = 0;
    }else{
      $response['adrs'] = 2;
      $response['err'] = 1;
    }
    if ($user['usercompanyId']!=0){
      $response['cmp'] = 1;
      $response['err'] = 0;
    }else{
      $response['cmp'] = 2;
      $response['err'] = 1;
    }
    if ($user['reachoutId']!=0){
      $response['ro'] = 1;
      $response['err'] = 0;
    }else{
      $response['ro'] = 2;
      $response['err'] = 1;
    }
  }
  echo json_encode($response);
}
?>
