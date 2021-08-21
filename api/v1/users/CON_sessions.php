<?php
session_start();/*start browser session*/
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create Users instance*/
$db = new Ser_Users();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['userId']=0;
$response['roleId']=2;
$response['fullname']="";
$response['is_buyer']="";
$response['is_seller']="";
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get userId*/
  $users = $db->getUserId($_GET['jbidentifier']);
  $response['err']=0;
  $response['userId']=$users['userId'];
  $response['roleId']=$users['roleId'];
  $response['fullname']=$users['fullname'];
  $response['is_buyer']=$users['is_buyer'];
  $response['is_seller']=$users['is_seller'];
  echo json_encode($response);
}
?>
