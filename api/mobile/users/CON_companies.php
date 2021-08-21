<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call companies class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create Users instance*/
$db = new Ser_Users();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get all companies*/
  $companies = $db->getAllCompanies();
  /*fill result in json array*/
  $fp = fopen('../json/companies.json', 'w');
  fwrite($fp, json_encode($companies));
  fclose($fp);
}
?>
