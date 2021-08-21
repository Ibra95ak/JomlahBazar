<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create Product Instance*/
$db = new Ser_users();
/*response array*/
$response['err']=-1;
$response['suppliers']=array();
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get active suppliers*/
  $suppliers = $db->GetActiveSuppliers();
  if($suppliers){
    $response['err']=0;
    foreach ($suppliers as $supplier) {
      array_push($response['suppliers'],$supplier);
    }
  }else {
    $response['suppliers'] = Null;
  }
}
echo json_encode($response);
?>
