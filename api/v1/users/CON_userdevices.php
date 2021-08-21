<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call devices class*/
require_once '../../../'.DIR_MOD.'Ser_Devices.php';
/*Create devices instance*/
$db = new Ser_Devices();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['devices']=array();
/*URL parameters*/
$action=$_GET['action'];
if (isset($_GET['deviceId'])) {
    $deviceId=$_GET['deviceId'];
} else {
    $deviceId=0;
}
if ($action=='delete') {
  /*delete device*/
  $devices = $db->DeleteDeviceById($deviceId);
  if ($devices) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location:".DIR_VIEW.DIR_USR."/form_user.php?err=".$response['err']);
}
if ($action=='delete-admin') {
  /*delete device*/
  $devices = $db->DeleteDeviceById($deviceId);
  if ($devices) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
}
?>
