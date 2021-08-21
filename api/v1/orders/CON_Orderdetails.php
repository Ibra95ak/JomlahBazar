<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
//response array
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['reasons'] = array();
$action = $_GET['action'];
if ($action == 'get_refund_reasons') {
  $refund_reasons = $db->GetRefundReasons();
  if ($refund_reasons !== null) {
    foreach ($refund_reasons as $reason) {
      array_push($response['reasons'], $reason);
    }
  }
  echo json_encode($response);
}
?>
