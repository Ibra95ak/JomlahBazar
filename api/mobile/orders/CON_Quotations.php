<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
$db = new Ser_Orders();
//response array
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['quotations'] = array();
$response['quotation'] = array();
$response['negotiations'] = array();
$action = $_GET['action'];
switch ($action) {

case "submit_quotation":
  $quotation = new Ser_Orders();
  $userId = $_POST['userId'];
  $sellerId = $_POST['sellerId'];
  $productId = $_POST['productId'];
  $requiredBy = $_POST['required_by'];
  $quotation = $quotation->AddQuotation($userId, $sellerId, $productId, $requiredBy);
  $quotation_id = $quotation['insertId'];
  $quantity = $_POST['quantity'];
  $buyer_price = $_POST['offered_price'];
  $comment = $_POST['comment'];
  $negotiation = $db->createNegotiation($quotation_id, $quantity, $buyer_price, $comment);
  $date = date('Y-m-d');
  if ($negotiation == true) {
    $response['err'] = 0;
  } else {
    $response['err'] = 1;
  }
  break;

case "get_quotations":
  $userId = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $quotations = $db->GetQuotations($userId, $from, $to);
  if ($quotations) {
    foreach ($quotations as $quotation) {
      array_push($response['quotations'],$quotation);
    }
  }else {
    $response['quotations']=NULL;
  }
  break;

case "get_buyer_quotation_by_id":
  $userId = $_GET['userId'];
  $qid = $_GET['quotationId'];
  $quotations = new Ser_Orders();
  $quotations = $quotations->GetBuyerQuotationById($qid, $userId);
  array_push($response['quotation'],$quotations);
  break;

case "modify_quotation_by_buyer":

  $qid = $_POST['quotationId'];
  $qqty = $_POST['quantity'];
  $buyerprice = $_POST['buyer_price'];
  $sellerprice = $_POST['mffinalprice'];
  $sid = 1;

  $quotation = new Ser_Orders();
  $quotation = $quotation->ModifyQuotationByBuyer($qid, $qqty, $buyerprice, $sellerprice);
  $status = 'modified';
  if ($quotation == true) {
    header('location: ' . DIR_VIEW . 'orders/my-quotations.php?quotation=q' . $status);
  } else {
    echo "There is some error";
    exit();
  }

  break;

case "get_negotiations_of_quotation":

  $qid = $_GET['qid'];
  $sid = 1;
  $negotiations = new Ser_Orders();
  $negotiations = $negotiations->GetNegotiationsOfQuotation($qid, $sid);
  foreach ($negotiations as $negotiation) {
    array_push($response['negotiations'],$negotiation);
  }


  break;

case "change_quotation_status_by_buyer":

  $negoid = $_POST['negoid'];
  $uid = 1;
  $status = $_POST['status'];

  //var_dump($_POST);
  //exit();

  $comment = ($status == 'accepted' ? 'accepted by the buyer' : 'cancelled by the buyer');
  $nstatus = ($status == 'accepted' ? 'closed' : 'cancelled');
  //var_dump($_POST);
  //exit();
  $negotiation = new Ser_Orders();
  $negotiation = $negotiation->ChangeNegotiationStatusByBuyer($negoid, $uid, $nstatus, $comment);

  //var_dump($negotiation);
  //exit();

  $negotiation_details = new Ser_Orders();
  $negotiation_details = $negotiation_details->getNegotiationDetailsById($negoid);

  //var_dump($negotiation_details);
  //exit();

  if ($negotiation_details['status'] == 'closed') {
    $quoid = $negotiation_details['quotation_id'];
    $quoqty = $negotiation_details['quantity'];
    if ($negotiation_details['seller_price'] !== NULL) {
      $quoprice = $negotiation_details['seller_price'];
    } else {
      $quoprice = $negotiation_details['buyer_price'];
    }
    $quostatus = 'accepted';
    $quotation = new Ser_Orders();
    $quotation = $quotation->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
  } elseif ($negotiation_details['status'] == 'cancelled') {
    $quoid = $negotiation_details['quotation_id'];
    $quoqty = NULL;
    $quoprice = NULL;
    $quostatus = 'cancelled';
    $quotation = new Ser_Orders();
    $quotation = $quotation->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
  }

  $status = 'modified';
  header('location: ' . DIR_VIEW . 'orders/my-quotations.php?quotation=q' . $status);

  break;
  }
  echo json_encode($response);
?>
