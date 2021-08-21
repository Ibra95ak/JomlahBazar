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
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get userId*/
  $users = $db->getUserId($_GET['jbidentifier']);
  $response['err']=0;
  $response['userId']=$users['userId'];
  echo json_encode($response);
}
?>
