<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Orders.php';
require_once '../../../'.DIR_MOD.'Ser_Orderdetails.php';
require_once '../../../' . DIR_MOD . 'Ser_Products.php';
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Addresses.php';
require_once '../../../' . DIR_MOD . 'Ser_Carts.php';
require_once '../../../' . DIR_MOD . 'Ser_Notif.php';
require_once '../../../' . DIR_MOD . 'Ser_Wallets.php';

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$db = new Ser_Orders();
$dbd = new Ser_Orderdetails();
$dbu = new Ser_Users();
$dba = new Ser_Addresses();
$dbc = new Ser_Carts();
$products = new Ser_Products();
$notifications = new Ser_Notif();
$dbw = new Ser_Wallets();

//response array
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['rate'] = 0;
$response['orders'] = array();
$response['order_info'] = array();
$response['orderdetails']= array();
$response['payments'] = array();
$response['details'] = array();
$response['order_shipment']= array();
$response['user_info']= array();
$response['order_address']= array();
$response['order_payment']= array();
$response['orderdetailIds'] ='';
$response['orders_count'] = '0';
$response['payment_info'] = array();
$response['payments'] = '';
$response['buyer_info'] = array();
$response['buyer_company'] = array();
$action = $_GET['action'];
if ($action == 'get') {
  $orders = $db->GetOrdersByUserId($_GET['userId']);
  echo json_encode($orders);
}
if ($action == 'seller_orders') {
  $id = $_POST['userId'];
  $from = $_POST['from'];
  $to = $_POST['to'];
  $orders = $db->GetOrderBySupplierId($id, $from, $to);
  if ($orders) {
    foreach ($orders as $order) {
      $order['order_statusId'] = $order['statusId'];
      $shipment = $db->GetshipmentByOrderId($order['orderId']);
      if ($shipment) {
        $order['shipmentId'] = $shipment['shipmentId'];
        $order['statusId'] = $shipment['statusId'];
        $order['shipment_date'] = $shipment['shipment_date'];
        $order['type'] = $shipment['type'];
        $order['shipped_by'] = $shipment['shipped_by'];
        $order['awbpdf'] = $shipment['awbpdf'];
        $order['tracking_number'] = $shipment['tracking_number'];
      }else {
        $order['shipmentId'] = 0;
        $order['statusId'] = '';
        $order['shipment_date'] = '';
        $order['type'] = '';
        if ($order['shipment_type']==3) {
          $order['shipped_by'] = 3;
        }else {
          $order['shipped_by'] = 'NONE';
        }

        $order['awbpdf'] = '';
        $order['tracking_number'] = '';
      }
      $payment = $db->GetpaymentByOrderId($order['orderId']);
      if ($payment) {
        $order['payment_type'] = $payment['payment_type'];
        $order['payment_status'] = $payment['status'];
      }else {
        $order['payment_type'] = 0;
        $order['payment_status'] = NULL;
      }
      array_push($response['orders'],$order);
    }
  }else {
    $response['orders'] = NULL;
  }

  echo json_encode($response['orders']);
}
if ($action == 'seller_payments') {
  $id = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $payments = $db->GetPaymentsBySupplierId($id, $from, $to);
  foreach ($payments as $payment) {
    array_push($response['payments'],$payment);
  }
  echo json_encode($response['payments']);
}
if ($action == 'get_orders') {
  $userId = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $orders = $db->GetOrdersByUserId($userId, $from, $to);
  if ($orders !== null) {
    foreach ($orders as $order) {
      $order_address = $dba->getAddressById($order['addressId']);
      $order['orderlatitude'] = $order_address['latitude'];
      $order['orderlongitude'] = $order_address['longitude'];
      $seller_address = $dba->getDefaultAddressByUserId($order['sellerId']);
      $order['sellerlatitude'] = $seller_address['latitude'];
      $order['sellerlongitude'] = $seller_address['longitude'];
      $shipment = $db->GetshipmentByOrderId($order['orderId']);
      if ($shipment) {
        $order['shipmentId'] = $shipment['shipmentId'];
        $order['shipment_status'] = $shipment['statusId'];
        $order['shipment_date'] = $shipment['shipment_date'];
        $order['type'] = $shipment['type'];
        $order['shipped_by'] = $shipment['shipped_by'];
        $order['awbpdf'] = $shipment['awbpdf'];
        $order['tracking_number'] = $shipment['tracking_number'];
      }else {
        $order['shipmentId'] = 0;
        $order['shipment_status'] = 0;
        $order['shipment_date'] = '';
        $order['type'] = '';
        $order['shipped_by'] = 'NONE';
        $order['awbpdf'] = '';
        $order['tracking_number'] = '';
      }
      $payment = $db->getPaymentByOrderNumber($order['ordernumber']);
      if ($payment) {
        $order['paymentId'] = $payment['paymentId'];
        $order['payment_date'] = $payment['payment_date'];
        $order['payment_type'] = $payment['payment_type'];
        $order['paymentfees'] = $payment['paymentfees'];
        $order['jbfees'] = $payment['jbfees'];
        $order['total_price'] = $payment['total_price'];
        $order['refId'] = $payment['refId'];
        $order['pay_status'] = $payment['status'];
        $order['receipt'] = $payment['receipt'];
      }else {
        $order['paymentId'] = 0;
        $order['payment_date'] = '';
        $order['payment_type'] = 0;
        $order['paymentfees'] = '';
        $order['jbfees'] = 0;
        $order['total_price'] = 0;
        $order['refId'] = '';
        $order['pay_status'] = '';
        $order['receipt'] = '';
      }
      $seller = $dbu->getUserById($order['sellerId']);
      $usercompanyId=$seller['usercompanyId'];
      $company = $dbu->getUserCompany($usercompanyId);
      $order['companyname'] = $company['companyname'];
      array_push($response['orders'], $order);
    }
  }
  echo json_encode($response);
}
if ($action == 'get_order_details') {
  $orderId = $_GET['orderId'];
  $orderdetails = $dbd->GetOrderdetailByOrderId($orderId);
  if ($orderdetails !== null) {
    foreach ($orderdetails as $orderdetail) {
      $status = $dbd->getStatusById($orderdetail['statusId']);
      $orderdetail['status'] = $status['status'];
      array_push($response['orders'], $orderdetail);
    }
  }
  echo json_encode($response);
}
if ($action == 'cancel_order') {
  $order = $_GET['orderId'];
  $user = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $order = $db->cancelOrder($order, $user);

  /* Send Email */
  $mail = new PHPMailer(true);
  //Server settings
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'talal.javed@pomechain.com';                     // SMTP username
  $mail->Password   = 'pomechainEmail@1';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  //Recipients
  $mail->setFrom('talal.javed@pomechain.com', 'From Pomechain');
  $mail->addAddress('imuolian@gmail.com', 'Talal Javed');     // Add a recipient

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Welcome to Pomechain';
  $mail->Body    = file_get_contents("../../../mail/templates/cancel_order.php");

  $sta = $mail->send();

  /* Send Email */


  if ($order == true) {
    header('location: ' . DIR_VIEW . DIR_ORD . 'b2c-my-orders.php?from=' . $from . '&to=' . $to . '&order=cancelled');
  } else {
    echo "There is some error";
    exit();
  }
}
if ($action == 'refund_order') {
  $order = $_GET['orderId'];
  $user = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $order = $db->refundOrder($order, $user);


  /* Send Email */
  $mail = new PHPMailer(true);
  //Server settings
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'talal.javed@pomechain.com';                     // SMTP username
  $mail->Password   = 'pomechainEmail@1';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  //Recipients
  $mail->setFrom('talal.javed@pomechain.com', 'From Pomechain');
  $mail->addAddress('imuolian@gmail.com', 'Talal Javed');     // Add a recipient

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Welcome to Pomechain';
  $mail->Body    = file_get_contents("../../../mail/templates/cancel_order.php");

  $sta = $mail->send();

  /* Send Email */


  if ($order == true) {
    header('location: ' . DIR_VIEW . DIR_ORD . 'b2c-my-orders.php?from=' . $from . '&to=' . $to . '&order=refunded');
  } else {
    echo "There is some error";
    exit();
  }
}
if ($action == 'post-shipment') {
  $shipmentId=$_POST['shipmentId'];
  $shipped_by=$_POST['shipped_by'];
  $orderId=$_POST['shipment_orderId'];
  $type=1;
  $cost=20;
  if ($shipmentId!=0) {
    $shipment = $dbd->updateShippedby($shipmentId, $shipped_by);
  }else {
    $shipment = $db->addshipment($orderId, $type, $shipped_by, $cost);
  }
  if ($shipment) {
    $response['err'] = 0;
    if ($shipped_by == 1) {
      $order_info = $db->GetOrderById($orderId);
      $user_info = $dbu->getUserById ($order_info['userId']);
      $notification_email=$user_info['email'];
      $notification_fullname=urlencode($user_info['fullname']);
      $summary_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Order Summary:</td></tr><tr><td>Order #: </td><td>'.$order_info['ordernumber'].'</td></tr><tr><td>Order Date: </td><td>'.$order_info['order_date'].'</td></tr><tr><td>Date Shipped:</td><td>'.date("F d, Y").'</td></tr><tr><td>Amount Charged:</td><td>AED '.$order_info['total_price'].'</td></tr><tr><td>Total Quantity:</td><td> '.$order_info['total_quantity'].'</td></tr></table>';
      $ship_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Here are your tracking numbers for the items shipped:</td></tr><tr><td>Carrier </td><td>Tracking Number</td></tr><tr><td>Delivered By Seller</td><td>Contact seller to get more info.</td></tr></table>';
      if ($notification_email) {
        /* Send Email buyer*/
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
            $mail->Password   = 'Notify@pomechain20';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
            $mail->addAddress($notification_email, $notification_fullname);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your order is ready for shipment';
            $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order Shipped</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear '.$user_info['fullname'].',</p><p>This is to confirm that your order has now been shipped.</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$summary_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$ship_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
            $mail->Body    = $msg;
            $mail->send();
            $response['err']=0;
        } catch (Exception $e) {
            $response['err']=1;
        }
        /* Send Email */
    }
  }
  }else {
    $response['err'] = 1;
  }
  echo json_encode($response);
}
if ($action == 'get-rate') {
  $useraddressId=$_GET['useraddressId'];
  $order_address = $dba->getAddressById($useraddressId);
  $buyer_country = $order_address['country'];
  if ($buyer_country=="AE") {
      $buyer_cart = $dbc->GetCartSellerWeightByUserId($order_address['userId']);
      foreach ($buyer_cart as $item) {
        $seller_address = $dba->getDefaultAddressByUserId($item['sellerId']);
        if ($seller_address['country']=="AE") {
          $weight = $item['total_weight']*$item['total_quantity'];
          $weight = ceil($weight);
          if ($weight<=5) {
            $total_rate =16;
          }elseif ($weight>30) {
            $response['err'] = 1;
            break;
          }else{
            $extra =  ($weight-5)*2;
            $total_rate =16+$extra;
          }
          $response['rate'] += $total_rate;
          $response['err'] = 0;
        }else {
          $response['err'] = 1;
          break;
        }
      }
  }else{
    $response['err'] = 1;
  }
  echo json_encode($response);
}
if ($action == 'get-uncompleted-orders') {
  $supplierId=$_GET['supplierId'];
  $count = $db->GetUncompletedOrders($supplierId);
  $response['orders_count'] = $count['orders_count'];
  echo json_encode($response);
}
if ($action == 'get-uncompleted-quotations') {
  $supplierId=$_GET['supplierId'];
  $count = $db->GetUncompletedQuotations($supplierId);
  $response['quotations_count'] = $count['quotations_count'];
  echo json_encode($response);
}
if ($action == 'confirm') {
  $orderdetailId=$_GET['orderdetailId'];
  $ini = $dbd->IntiateOrderSeller($orderdetailId,2);
  $user_info = $dbd->GetOrderdetailBuyer($orderdetailId);
  $notification_email=$user_info['email'];
  $notification_fullname=urlencode($user_info['fullname']);
  $notification_ordernumber=$user_info['ordernumber'];
  if ($notification_email) {
    /* Send Email buyer*/
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
        $mail->Password   = 'Notify@pomechain20';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
        $mail->addAddress($notification_email, $notification_fullname);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Order has been confirmed.';
        $msg ='<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order # '.$notification_ordernumber.'</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear '.$user_info['fullname'].',</p><p>Seller approved your order('.$notification_ordernumber.')! This message is to confirm that your order has been accepted by the seller successfully. A separate email will be sent once the order has been shipped already. You can view the status of your order or make changes to it by visiting <a href="'.DIR_VIEW.DIR_ORD.'b2c-my-orders.php">Your Orders</a> on jomlahbazar.com.</p></td></tr><tr><td style="padding:10px 30px;margin:0;"><p>Thanks & best regards</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
        $mail->Body    = $msg;
        $mail->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
    /* Send Email */
  }
  header("location:".DIR_VIEW.DIR_ORD.'received_orders_detail.php?orderdetailId='.$orderdetailId);
}
if ($action == 'reject') {
  $orderdetailId=$_GET['orderdetailId'];
  $ini = $dbd->IntiateOrderSeller($orderdetailId,4);
  $user_info = $dbd->GetOrderdetailBuyer($orderdetailId);
  $notification_email=$user_info['email'];
  $notification_fullname=urlencode($user_info['fullname']);
  $notification_ordernumber=$user_info['ordernumber'];
  if ($notification_email) {
    /* Send Email buyer*/
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
        $mail->Password   = 'Notify@pomechain20';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
        $mail->addAddress($notification_email, $notification_fullname);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Order has been cancelled.';
        $msg ='<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order # '.$notification_ordernumber.'</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear '.$user_info['fullname'].',</p><p>Seller cancelled your order('.$notification_ordernumber.')! This message is to confirm that your order has been rejected by the seller. You can view the status of your order or make changes to it by visiting <a href="'.DIR_VIEW.DIR_ORD.'b2c-my-orders.php">Your Orders</a> on jomlahbazar.com.</p></td></tr><tr><td style="padding:10px 30px;margin:0;"><p>Thanks & best regards</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
        $mail->Body    = $msg;
        $mail->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
    /* Send Email */
  }
  header("location:".DIR_VIEW.DIR_ORD.'received_orders_detail.php?orderdetailId='.$orderdetailId);
}
if($action=='post'){
  $today = date("dmY");
  $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
  $uniqueOrderNo = $today . $rand;
  $response = array();
  $userId = $_POST['userId'];
  $addressId = $_POST['addressId'];
  $payment = $_POST['payment_type'];
  $order_total = $_POST['TotalPrice'];
  $order_otherfees = $_POST['otherfees'];
  $order_shipmentfees = $_POST['shipmentfees'];
  $walletId = 0;
  $usercart = $dbc->GetCartSuppliersByUserId($userId);
  $orderNumber = $uniqueOrderNo;
  if ($payment=='4'){
    $statusId = 8;
    $handling = 2;
  }else{
    $statusId = 1;
    $handling = 1;
  }
  $blockId = 1;
  $active = 1;
  /* PAYMENTS TABLE */
  $ref_id="0";
  $status="Pending";
  $payment_fees=0;
  $shipment_fees=0;
  $jb_fees=0;
  $promotion=0;
  foreach ($usercart as $item) {
    $rand = rand();
    $rand = strtoupper(substr(uniqid(sha1($rand)), 0, 6));
    $uniquetaxNo = $today . $rand;
    $taxNumber = $uniquetaxNo;
    $totalSellerQuantity = $item['total_quantity'];
    $totalSeller = $item['total_seller'];
    $totalSellerWeight = $item['total_weight'];
    $shipment_type = $item['shipment_type'];
    $payment_type = $item['payment_type'];
    $sellerId = $item['sellerId'];

    if ($shipment_type==1) {
      if ($totalSellerWeight<=5) {
        $shipment_fees =16;
      }elseif ($totalSellerWeight>30) {
        $shipment_fees =0;
        break;
      }else{
        $extra =  ($weight-5)*2;
        $shipment_fees =16+$extra;
      }
    }else {
      $shipment_fees =0;
    }
    $payment_type_fees = $dbw->GetPaymentSellerFeesById($payment_type);
    if ($payment_type_fees) {
      $payment_fees = $totalSeller*$payment_type_fees['percentage'];
    }else {
      $payment_fees = 0;
    }
    $usercartproducts = $dbc->GetBuyerSellerCart($userId,$sellerId);
    $order_totalPrice = floatval($totalSeller)-$promotion;
    $ord = $db->addOrder($handling, $userId, $sellerId, $orderNumber,$taxNumber, $totalSellerQuantity, $order_totalPrice, $totalSellerWeight, $shipment_type, $statusId, $addressId, $walletId, $active);
    $orderId = $ord[0]['insertId'];
    $response['orderNumber']=$orderNumber;
    $total_payment = $totalSeller+$shipment_fees+$payment_fees;
    $total_payment = $total_payment+($total_payment*0.05);
    $pay_seller = $pay=$db->AddOrderToSellerPayments($orderId, $orderNumber, $payment_type, round($payment_fees,2), round($shipment_fees,2),0, round($total_payment,2), NULL, "Pending");
    foreach ($usercartproducts as $detailitem) {
      $productId = $detailitem['productId'];
      $product_info = $products->GetproductById($productId);
      $order_number = $uniqueOrderNo;
      $discount = 0;
      $quantity = $detailitem['quantity'];
      $product_totalweight = $detailitem['quantity']*$product_info['weight'];
      $totalprice = $detailitem['price']* $detailitem['quantity'];
      if ($payment=='3') $statusId = 8;
      else $statusId = 1;
      $active = 1;
      $details = $dbd->addOrderdetail($orderId, $productId, $order_number, $discount, $quantity, $totalprice, $product_totalweight, $statusId, $active);
      $orderdetailId = $details['insertId'];
      $desc_table = '<table style="width:100%;text_align:left;"><tr><th>Description</th><th>Handling Time</th><th>Price</th></tr><tr><td style="width: 250px;">'.$product_info['name'].'</td><td>1-3 days</td><td>AED '.$totalprice.'</td></tr></table>';
      $update_supplier_inv = $products->updateInventoryless($detailitem['sellerId'], $productId, $quantity);
      $update_product_inv = $products->updateTotalInventoryless($productId, $quantity);
      /*send seller email notification*/
      $seller_info = $dbu->getUserById($detailitem['sellerId']);
      $store_info = $dbu->getUserCompany($seller_info['usercompanyId']);
      $default_address = $dba->getDefaultAddressByUserId($detailitem['sellerId']);
      $seller_notification_email=$seller_info['email'];
      $seller_notification_fullname=urlencode($store_info['companyname']);
      if ($seller_notification_email) {
        /* Send Email seller*/
        $mails = new PHPMailer(true);
        try {
            //Server settings
            //$mails->SMTPDebug = SMTP::DEBUG_SERVER;
            $mails->isSMTP();                                            // Send using SMTP
            $mails->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mails->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mails->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
            $mails->Password   = 'Notify@pomechain20';                               // SMTP password
            $mails->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mails->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mails->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
            $mails->addAddress($seller_notification_email, $seller_notification_fullname);     // Add a recipient

            // Content
            $mails->isHTML(true);                                  // Set email format to HTML
            $mails->Subject = 'JomlahBazar NEW ORDER';
            $msg ='<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hello '.$seller_notification_fullname.',</p><p>Congratulations! You just sold an item on JomlahBazar!</p><p>Please confirm that you have the following items in stock and get ready to ship. </p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_ORD.'CON_Orders.php?action=confirm&orderdetailId='.$orderdetailId.'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Confirm sales order</a>&nbsp;&nbsp;<a href="'.DIR_CONT.DIR_ORD.'CON_Orders.php?action=reject&orderdetailId='.$orderdetailId.'" style="background:#c91b09 ;color:#FFF;padding:10px;text-decoration:none;">Reject sales order</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;">'.$desc_table.'</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Funds will be available for withdrawal from JomlahBazar.com after <b>3 days</b> from receiving the order by the buyer. You will be required to ship your items first. </p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><ul style="list-style: none;"><li><b>Item location:</b></li><li>'.$seller_notification_fullname.'</li><li>'.$default_address['address1'].'</li><li>'.$default_address['country'].'</li><li>'.$default_address['city'].'</li></ul></td></tr><tr><td style="padding:10px 30px;text-align:left;margin:0"><h2><b>what&#39;s next?</b></h2><ul><li>Make sure the sold items are properly packaged. It is your responsibility that items get to the buyer in one piece!</li><li>Print and label the packages using the provided Airway Bill (AWB)</li><li>JomlahBazar.com will collect money from the buyer and credit your account upon successful completion.</li></ul></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
            $mails->Body    = $msg;
            $mails->send();
            $response['err']=0;
        } catch (Exception $e) {
            $response['err']=1;
        }
      }
    }
  }
  switch ($payment) {
    case '1':
      $pay_buyer=$db->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
      break;
    case '2':
      $pay_buyer=$db->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
      break;
    case '3':
      $pay_buyer=$db->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
      break;
    default:
      $pay_buyer=$db->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),0, round($order_total,2), NULL, "Pending");
      break;
  }
  /*send buyer notification*/
  $user_info = $dbu->getUserById($userId);
  $order_address = $dba->getAddressById($addressId);
  $notification_email=$user_info['email'];
  $notification_fullname=urlencode($user_info['fullname']);
  $deleteCart = $db->DeleteAllCartByUserId($userId);
  $buyer_table = '<table style="width:100%;text_align:left;"><tr><td>Arriving:<br>1-3 days</td><td>Order is sent to:<br>'.$user_info['fullname'].'<br>'.$order_address['city'].','.$order_address['country'].'</td></tr><tr><td colspan="2">Your delivery option:<br>Standard Delivery</td></tr></table>';
  $summary_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Order Summary:</td></tr><tr><td colspan="2">Order #: '.$orderNumber.'</td></tr><tr><td colspan="2">Place on: '.date("F d, Y").'</td></tr><tr><td>Item Subtotal:</td><td>AED '.$totalprice.'</td></tr><tr><td>Cash On Delivery Fee:</td><td>AED 10.00</td></tr><tr><td>Promotion Applied:</td><td>AED 0.00</td></tr><tr><td><b>Order Total:</b></td><td><b>AED '.$order_totalPrice.'</b></td></table>';
  if ($notification_email) {
    /* Send Email buyer*/
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
        $mail->Password   = 'Notify@pomechain20';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
        $mail->addAddress($notification_email, $notification_fullname);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Order has been sent.';
        $msg ='<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Order</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear '.$user_info['fullname'].',</p><p>Thank you for your order! This message is to confirm that your order has been processed successfully. A separate email will be sent once the order has been shipped already. You can view the status of your order or make changes to it by visiting <a href="'.DIR_VIEW.DIR_ORD.'b2c-my-orders.php">Your Orders</a> on jomlahbazar.com.</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;">'.$buyer_table.'</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;">'.$summary_table.'</td></tr><tr><td style="padding:10px 30px;margin:0;"><p>Thanks & best regards</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
        $mail->Body    = $msg;
        $mail->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
    /* Send Email */
  }
  if ($payment_type==3) {
    /* Send payment email to accounting*/
    $payment_summary_table = '<table style="width:100%;text_align:left;"><tr><td colspan="2">Payment Summary:</td></tr><tr><td colspan="2">Order #: '.$orderNumber.'</td></tr><tr><td colspan="2">Place on: '.date("F d, Y").'</td></tr><tr><td>Other fees:</td><td>AED '.round($order_otherfees,2).'</td></tr><tr><td>Shipment Fee:</td><td>AED '.round($order_shipmentfees,2).'</td></tr><tr><td>Payment type:</td><td>Bank Transfer</td></tr><tr><td><b>Total:</b></td><td><b>AED '.round($order_total,2).'</b></td></table>';
    $mail_acc = new PHPMailer(true);
    try {
        //Server settings
        //$mail_acc->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail_acc->isSMTP();                                            // Send using SMTP
        $mail_acc->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail_acc->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail_acc->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
        $mail_acc->Password   = 'Notify@pomechain20';                               // SMTP password
        $mail_acc->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail_acc->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail_acc->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
        $mail_acc->addAddress('accounting@pomechain.com', 'Accounting');     // Add a recipient

        // Content
        $mail_acc->isHTML(true);                                  // Set email format to HTML
        $mail_acc->Subject = 'Buyer Payment Notification.';
        $msg ='<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;">Buyer Payment Notification</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Dear Accounting Team,</p><p>A new bank transfer has been made to JomlahBazar.</p></td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>'.$payment_summary_table.'</p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
        $mail_acc->Body    = $msg;
        $mail_acc->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
    /* Send payment email to accounting */
  }
  echo json_encode($response);
}
if ($action == 'refund_product_order') {
  $orderdetailId = $_POST['refund_orderdetailId'];
  $userId = $_POST['userId'];
  $reasonId = $_POST['reason'];
  $refund = $dbd->AddRefund($userId, $orderdetailId, $reasonId);
  if ($refund) {
    $orderDetail_refund = $dbd->RefundOrderdetailBuyer($orderdetailId);
    if ($orderDetail_refund) {
      $response['err'] = 0;
    }else {
    $response['err'] = 1;
    }
  }else {
    $response['err'] = 1;
  }
  echo json_encode($response);
}
if ($action == 'cancel_product_order') {
  $cancelled = 0;
  if (isset($_GET['userId'])) $userId = $_GET['userId'];
  else $userId = $_GET['sellerId'];
  $orderdetailId = $_GET['orderdetailId'];
  $orderDetail_cancel = $dbd->CancelOrderdetailBuyer($orderdetailId);
  if ($orderDetail_cancel) {
    $orderDetail = $dbd->GetOrderdetailById($orderdetailId);
    $orderId = $orderDetail['orderId'];
    $ordernumber = $orderDetail['ordernumber'];
    $orderdetails = $dbd->GetOrderdetailByOrderId($orderId);
    foreach ($orderdetails as $detail) {
      if ($detail['statusId']!=4) {
        $cancelled = 1;
      }
    }
    if ($cancelled == 0) {
      if (isset($_GET['userId'])) $order = $db->cancelOrder($orderId, $userId);
      else $order = $db->cancelOrderBySeller($orderId, $userId);
      if ($order) {
        $order_payment = $db->getPaymentByOrderNumber($ordernumber);
        if ($order_payment['payment_type']==1 || $order_payment['payment_type']==5) {
          $buyer_payment_cancel = $db->cancelPaymentByOrderNumber($ordernumber);
          $seller_payment_cancel = $db->cancelPaymentByOrderId($orderId);
        }
      }
    }
  }
}
if ($action=="get_received_order_details") {
  $orderdetailId = $_GET['orderdetailId'];
  $order_Details = $dbd->GetOrderdetailById($orderdetailId);
  array_push($response['orderdetails'],$order_Details);
  $order = $db->GetOrderById($order_Details['orderId']);
  array_push($response['orders'],$order);
  $user_info = $dbu->getUserById($order['userId']);
  array_push($response['user_info'],$user_info);
  $order_address = $dba->getAddressById($order['addressId']);
  array_push($response['order_address'],$order_address);
  $order_payment = $db->getPaymentByOrderId($order_Details['orderId']);
  array_push($response['order_payment'],$order_payment);
  $orderDetails_shipment = $db->GetshipmentByOrderId($order_Details['orderId']);
  if ($orderDetails_shipment) {
    array_push($response['order_shipment'],$orderDetails_shipment);
  }else {
    $response['order_shipment']=NULL;
  }
  echo json_encode($response);
}
if ($action == 'complete_order') {
  $orderId = $_POST['orderId'];
  $order_complete = $db->CompleteOrderSeller($orderId);
  $orderdetails_complete = $dbd->CompleteOrderdetailsSeller($orderId);
}
if ($action == 'get-jb-invoice') {
  $ordernumber=$_GET['ordernumber'];
  $orders_info = $db->GetOrderByOrdernumber($ordernumber);
  $orders_payment = $db->getPaymentByOrderNumber($ordernumber);
  array_push($response['payment_info'],$orders_payment);
  $userId =$orders_info[0]['userId'];
  $addressId =$orders_info[0]['addressId'];
  foreach ($orders_info as $order) {
    $order['payment_info']=array();
    $order['seller_info']=array();
    $order['seller_company']=array();
    $order['seller_default_address']=array();
    $order['orderdetails']=array();
    $payment_info = $db->getPaymentByOrderId($order['orderId']);
    if ($payment_info) {
      array_push($order['payment_info'],$payment_info);
    }else {
      $order['payment_info']=null;
    }
    $seller = $dbu->getUserById($order['sellerId']);
    array_push($order['seller_info'],$seller);
    $usercompanyId=$seller['usercompanyId'];
    $company = $dbu->getUserCompany($usercompanyId);
    array_push($order['seller_company'],$company);
    $address = $dba->getDefaultAddressByUserId($order['sellerId']);
    array_push($order['seller_default_address'],$address);
    $orderdetails = $dbd->GetOrderdetailByOrderId($order['orderId']);
    foreach ($orderdetails as $item) {
      if ($item['statusId']!=4) {
        array_push($order['orderdetails'],$item);
      }
    }
    array_push($response['order_info'],$order);
  }
  $buyer = $dbu->getUserById($userId);
  array_push($response['buyer_info'],$buyer);
  if ($buyer['usercompanyId']!=0) {
    $buyercompanyId=$buyer['usercompanyId'];
    $buyercompany = $dbu->getUserCompany($buyercompanyId);
    array_push($response['buyer_company'],$buyercompany);
  }else {
    $response['buyer_company']=null;
  }
  $order_address = $dba->getAddressById($addressId);
  array_push($response['order_address'],$order_address);
  echo json_encode($response);
}
