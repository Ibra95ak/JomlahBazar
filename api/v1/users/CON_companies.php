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
$response['companies']=array();
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get all companies*/
  $companies = $db->getAllCompanies();
  if ($companies) {
      foreach ($companies as $company) {
          array_push($response['companies'], $company);
      }
  }
  echo json_encode($response['companies']);
}
?>
