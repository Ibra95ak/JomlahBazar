<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call roles class*/
require_once '../../../'.DIR_MOD.'Ser_Roles.php';
/*Create Users instance*/
$db = new Ser_Roles();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get all roles*/
  $roles = $db->getallActiveRoles();
  /*fill result in json array*/
  $fp = fopen('../json/roles.json', 'w');
  fwrite($fp, json_encode($roles));
  fclose($fp);
}
if ($action=='get-services') {
  /*get all roles*/
  $roles = $db->getallActiveServiceRoles();
  /*fill result in json array*/
  $fp = fopen('../json/servicesroles.json', 'w');
  fwrite($fp, json_encode($roles));
  fclose($fp);
}
?>
