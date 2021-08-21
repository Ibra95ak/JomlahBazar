<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create products instance*/
$db = new Ser_Products();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['products']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['userId'])) $userId=$_GET['userId'];
else {
  $userId=0;
}
if ($action=='get') {
  if($userId!=0){
    $response = $db->GetProductsBySupplierId($userId);
    echo json_encode($response);
  }else{
    /*error*/
  }
}
