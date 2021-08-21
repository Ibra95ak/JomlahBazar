<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Reachouts.php';
/*Call Addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Wallets.php';
/*Create Users instance*/
$db = new Ser_Users();
/*Create address instance*/
$dba = new Ser_Addresses();
/*Create reachout instance*/
$dbr = new Ser_Reachouts();
/*Create wallet instance*/
$dbw = new Ser_Wallets();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['verified']=-1;
$response['info']=array();
$response['address']=array();
$response['reachout']=array();
$response['users']=array();
$response['users_filtered']=array();
$response['credit_cards']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['userId'])) $userId=$_GET['userId'];
else $userId=0;
if ($action=='get') {
  if($userId!=0){
    /*get user by Id*/
    $user = $db->getUserById($userId);
    if($user){
      $response['err']=0;
      array_push($response['info'],$user);
    }
    /*get user address*/
    $address = $dba->getAllAddressesByUserId($userId);
    if($address){
      $response['err']=0;
      array_push($response['address'],$address);
    }
    /*get user reachout*/
    $reachout = $dbr->GetReachoutById($user['reachoutId']);
    if($reachout){
      $response['err']=0;
      array_push($response['reachout'],$reachout);
    }
    /*get user cards*/
    $credit_cards = $db->getUserCreditCards($userId);
    if($credit_cards){
      $response['err']=0;
      foreach ($credit_cards as $credit_card) {
        array_push($response['credit_cards'],$credit_card);
      }
    }
    echo json_encode($response);
  }else{
    if(isset($_REQUEST['query'])) $filter_params=$_REQUEST['query'];
    else $filter_params="";
    $query = "SELECT * FROM users INNER JOIN address ON users.userId = address.userId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId INNER JOIN usr_reachout ON usr_reachout.reachoutId = users.reachoutId INNER JOIN usr_company on users.usercompanyId = usr_company.usercompanyId ";
    $where = "WHERE users.active=1 ";
    $groupby=" GROUP BY users.userId";
    if($filter_params!=""){
      if (isset($filter_params['brandId'])) {
        $query .= " INNER JOIN supplier_brands ON users.userId = supplier_brands.supplierId";
         $where.=" AND supplier_brands.brandId IN(".$filter_params['brandId'].")";
      }
      if (isset($filter_params['categoryId'])) {
        $query .= " INNER JOIN supplier_categories ON users.userId = supplier_categories.supplierId";
        $where.=" AND supplier_categories.categoryId=".$filter_params['categoryId'];
      }
      if (isset($filter_params['city'])) {
        $city = "'".$filter_params['city']."'";
        $where.=" AND address.city=".$city;
      }
      if (isset($filter_params['companyId'])) {
        $where.=" AND usr_company.usercompanyId=".$filter_params['companyId'];
      }
      if (isset($filter_params['generalSearch'])) {
        $text = "'%".$filter_params['generalSearch']."%'";
        $where.=" AND (usr_company.companyname LIKE ".$text.")";
      }
    }
    $sql=$query.$where.$groupby;
    /*get all users*/
    $users = $db->getallUsers($sql);
    if($users){
        foreach($users as $user){
            array_push($response['users'],$user);
        }
    }
    echo json_encode($response['users']);
  }

}
if ($action=='delete') {
  /*delete user*/
  $user = $db->DeleteUserById($userId);
  if ($user) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location: ".DIR_VIEW.DIR_USR."dt_users.php?err=".$response['err']);
}
if ($action=='verify') {
  $verifieduserId=$_GET['verifieduserId'];
  $verifiedbyuserId=$_SESSION['userId'];
  $work_other=0;
  /*CHeck if already verfied*/
  $verified = $db->isVerifiedByUser($verifieduserId,$verifiedbyuserId);
  if($verified){
    $verifyuser  = $db->unVerifyUserById($verifieduserId,$verifiedbyuserId);
    $response['verified']=0;
  }else{
    $verifyuser  = $db->VerifyUserById($verifieduserId,$verifiedbyuserId,$work_other);
    $response['verified']=1;
  }

  if ($verifyuser) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  echo json_encode($response);
}
?>
