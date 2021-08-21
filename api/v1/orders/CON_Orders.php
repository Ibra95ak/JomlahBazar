<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Orders.php';
require_once '../../../' . DIR_MOD . 'Ser_Orderdetails.php';
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Addresses.php';
require_once '../../../' . DIR_MOD . 'Ser_Products.php';
require_once '../../../' . DIR_MOD . 'Ser_Carts.php';
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
$dbp = new Ser_Products();
$dbc = new Ser_Carts();
$dbw = new Ser_Wallets();

//response array
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['orders'] = array();
$response['orderdetails'] = array();
$response['order_info'] = array();
$response['seller_info'] = array();
$response['seller_company'] = array();
$response['seller_default_address'] = array();
$response['buyer_info'] = array();
$response['buyer_company'] = array();
$response['order_address'] = array();
$response['payment_info'] = array();
$response['payments'] = '';
$response['orders_count'] = '0';
$response['rate'] = '0';
$response['buyer_country'] = '';
$action = $_GET['action'];
if ($action == 'get') {
  $orders = $db->GetOrdersByUserId($_GET['userId']);
  echo json_encode($orders);
}
if ($action == 'seller_orders') {
  $id = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $orders = $db->GetOrderBySupplierId($id, $from, $to);
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
        $order['shipped_by'] = 0;
      }

      $order['awbpdf'] = '';
      $order['tracking_number'] = '';
    }
    $payment = $db->GetpaymentByOrderId($order['orderId']);
    if ($payment) {
      $order['payment_total'] = $payment['total_price'];
      $order['payment_type'] = $payment['payment_type'];
      $order['payment_status'] = $payment['status'];
    }else {
      $order['payment_type'] = 0;
      $order['payment_type'] = 0;
      $order['payment_status'] = NULL;
    }
    array_push($response['orders'],$order);
  }
  echo json_encode($response['orders']);
}
if ($action == 'seller_payments') {
  $id = $_GET['userId'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $page = $_GET['page'];
  $pg = $_GET['pg'];
  $tbody = '';
  /*initialize limit clause for pagination*/
  $num_rec_per_page=5;/*records per page*/
  $start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
  $payments = $db->GetPaymentsBySupplierId($id, $from, $to, $start_from, $num_rec_per_page);
  $payments_count = $db->GetPaymentscount($id, $from, $to)['t_count'];

  if ($payments) {
    $i=0;
    $tbody .='<tbody>';
    foreach ($payments as $payment) {
      $counter = $i++;
      $tbody .='<tr>';
      $tbody .='<th scope="row">'.$counter.'</th>';
      $tbody .='<td>'.$payment['ordernumber'].'</td>';
      $tbody .='<td>'.$payment['payment_date'].'</td>';
      $tbody .='<td>AED '.$payment['total'].'</td>';
      $tbody .='<td>'.$payment['status'].'</td>';
      $tbody .='</tr>';
    }
  }else {
    $tbody .="<tr><td colspan='5'>No Records!</td></tr>";
  }
  $tbody .='<tbody>';
  $tbody .='<tfoot>';
  $pages=ceil($payments_count/$num_rec_per_page);
  $ppages=ceil($pages/5);
  $start = ($pg - 1) * 5;
  $offset1 = ($page - 1) * $num_rec_per_page + 1;
  $offset2 = $page * $num_rec_per_page;
  if($offset2>$payments_count) $offset2=$payments_count;
  if($pg<=1) $pgp=1;
  else $pgp=$pg-1;
  if($pg>=$ppages) $pgn=$ppages;
  else $pgn=$pg+1;
  if($page+1>0 && $page+1<=$pages) $next = $page+1;
  else $next = $pages;
  if($page-1>0 && $page-1<=$pages) $prev = $page-1;
  else $prev = 1;
  $tbody .='<tr>';
  $tbody .='<td colspan="7">';
  $tbody .='<div class="kt-portlet kt-mb-5">';
  $tbody .='<div class="kt-portlet__body kt-padding-2">';
  $tbody .='<div class="kt-pagination kt-pagination--dark kt-m5" style="margin-bottom: 13px !important;">';
  $tbody .='<div class="kt-pagination__toolbar">';
  $tbody .='</div>';
  $tbody .='<ul class="kt-pagination__links">';
  $tbody .='<li class="kt-pagination__link--first">';
  $tbody .='<a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page=1&pg=1"><i class="fa fa-angle-double-left kt-font-dark"></i></a>';
  $tbody .='<li class="kt-pagination__link--next">';
  $tbody .='<a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page='.$prev.'&pg='.$pgp.'"><i class="fa fa-angle-left kt-font-dark"></i></a>';
  $tbody .='</li>';
  $tbody .='</li>';
  $count=0;
  for($i=$start+1;$i<=$pages;$i++){
    $count++;
    if($count<=5){
      if($page==$i) $tbody .='<li class="kt-pagination__link--active"><a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page='.$i.'&pg='.$pg.'">'.$i.'</a></li>';
      else $tbody .='<li><a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page='.$i.'&pg='.$pg.'">'.$i.'</a></li>';
    }
    else $tbody .='';
  }
  $tbody .='<li class="kt-pagination__link--prev">';
  $tbody .='<a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page='.$next.'&pg='.$pgn.'"><i class="fa fa-angle-right kt-font-dark"></i></a>';
  $tbody .='</li>';
  $tbody .='<li class="kt-pagination__link--last">';
  $tbody .='<a href="'.DIR_VIEW.DIR_ORD.'my-payments.php?from='.$from.'&to='.$to.'&page='.$pages.'&pg='.$ppages.'"><i class="fa fa-angle-double-right kt-font-dark"></i></a>';
  $tbody .='</li>';
  $tbody .='<li class="transparent-bg"><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">';
  $tbody .='Displaying '.$offset1.' - '.$offset2.' of '.$payments_count.' records';
  $tbody .='</span></li>';
  $tbody .='</ul></div></div></div></td></tr>';
  $tbody .='</tfoot>';
  $response['payments']=$tbody;
  echo json_encode($response);
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
        $order['shipment_status'] = '';
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
  $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
  $mail->Password   = 'Notify@pomechain21';                                // SMTP password
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
  $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
  $mail->Password   = 'Notify@pomechain21';                                 // SMTP password
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
            $mail->Password   = 'Notify@pomechain21';                               // SMTP password
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
            $response['err'] = 2;
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
  }elseif ($buyer_country=="OM") {
    $buyer_cart = $dbc->GetCartSellerWeightByUserId($order_address['userId']);
    foreach ($buyer_cart as $item) {
      $seller_address = $dba->getDefaultAddressByUserId($item['sellerId']);
        $weight = $item['total_weight']*$item['total_quantity'];
        $weight = ceil($weight);
        if ($weight<=30) {
          $total_rate =$db->getAsyadRate($weight)['price'];
        }else{
          $response['err'] = 2;
          break;
        }
        $response['rate'] += $total_rate;
        $response['err'] = 0;
    }
  }else{
    $response['err'] = 1;
  }
  $response['buyer_country']=$buyer_country;
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
        $mail->Password   = 'Notify@pomechain21';                               // SMTP password
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
        $mail->Password   = 'Notify@pomechain21';                               // SMTP password
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
if ($action == 'complete_order') {
  $orderId = $_GET['orderId'];
  $order_complete = $db->CompleteOrderSeller($orderId);
  $orderdetails_complete = $dbd->CompleteOrderdetailsSeller($orderId);
}
if ($action == 'refund_product_order') {
  $refunded = 0;
  $orderdetailId = $_POST['refund_orderdetailId'];
  $userId = $_POST['userId'];
  $reasonId = $_POST['reason'];
  $refund = $dbd->AddRefund($userId, $orderdetailId, $reasonId);
  if ($refund) {
    $orderDetail_refund = $dbd->RefundOrderdetailBuyer($orderdetailId);
    if ($orderDetail_refund) {
        $orderDetail = $dbd->GetOrderdetailById($orderdetailId);
        $orderId = $orderDetail['orderId'];
        $orderdetails = $dbd->GetOrderdetailByOrderId($orderId);
        foreach ($orderdetails as $detail) {
          if ($detail['statusId']!=5) {
            $refunded = 1;
          }
        }
        if ($refunded == 0) {
          $order = $db->refundOrder($orderId, $userId);
        }
      $response['err'] = 0;
    }else {
    $response['err'] = 1;
    }
  }else {
    $response['err'] = 1;
  }
  echo json_encode($response);
}
if ($action == 'pay_receipt') {
  $paymentId = $_POST['paymentId'];
  $payment_receipt = $_POST['payment_receipt'];
  $payment = $db->UpdatePaymentReceipt($paymentId, $payment_receipt);
  if ($payment) $response['err'] = 0;
  else $response['err'] = 1;
  echo json_encode($response);
}
if ($action == 'ship_receipt') {
  $orderId = $_POST['ship_orderId'];
  $shipment_receipt = $_POST['shipment_receipt'];
  $shipment = $db->addshipmentreceipt($orderId,$shipment_receipt);
  if ($shipment) $response['err'] = 0;
  else $response['err'] = 1;
  echo json_encode($response);
}
if ($action == 'get-invoice') {
  $orderId=$_GET['orderId'];
  $order_info = $db->GetOrderById($orderId);
  array_push($response['order_info'],$order_info);
  $payment_info = $db->getPaymentByOrderId($orderId);
  if ($payment_info) {
    array_push($response['payment_info'],$payment_info);
  }else {
    $response['payment_info']=null;
  }
  $seller = $dbu->getUserById($order_info['sellerId']);
  array_push($response['seller_info'],$seller);
  $usercompanyId=$seller['usercompanyId'];
  $company = $dbu->getUserCompany($usercompanyId);
  array_push($response['seller_company'],$company);
  $address = $dba->getDefaultAddressByUserId($order_info['sellerId']);
  array_push($response['seller_default_address'],$address);
  $buyer = $dbu->getUserById($order_info['userId']);
  array_push($response['buyer_info'],$buyer);
  if ($buyer['usercompanyId']!=0) {
    $buyercompanyId=$buyer['usercompanyId'];
    $buyercompany = $dbu->getUserCompany($buyercompanyId);
    array_push($response['buyer_company'],$buyercompany);
  }else {
    $response['buyer_company']=null;
  }
  $order_address = $dba->getAddressById($order_info['addressId']);
  array_push($response['order_address'],$order_address);
  $orderdetails = $dbd->GetOrderdetailByOrderId($orderId);
  foreach ($orderdetails as $item) {
    array_push($response['orderdetails'],$item);
  }
  echo json_encode($response);
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
