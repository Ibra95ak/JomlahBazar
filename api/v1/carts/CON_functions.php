<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';
require_once '../../../' . DIR_MOD . 'Ser_Carts.php';
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Products.php';
require_once '../../../' . DIR_MOD . 'Ser_Addresses.php';
require_once '../../../' . DIR_MOD . 'Ser_Orders.php';
require_once '../../../' . DIR_MOD . 'Ser_Orderdetails.php';
require_once '../../../' . DIR_MOD . 'Ser_Notif.php';
require_once '../../../' . DIR_MOD . 'WishList.php';
require_once '../../../' . DIR_MOD . 'Ser_Wallets.php';
require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$client = new GuzzleHttp\Client();


$db = new Ser_Users();
$products = new Ser_Products();
$notifications = new Ser_Notif();
$carts = new Ser_Carts();
$dbd = new Ser_Orderdetails();
$dbo = new Ser_Orders();
$dba = new Ser_Addresses();
$dbw = new Ser_Wallets();
use Anam\Phpcart\Cart;

$action = $_GET['action'];
$response=array();
$response['err']=-1;
$response['orderNumber']= '';
$response['orderdetails']= array();
$response['order']= array();
$response['order_shipment']= array();
$response['user_info']= array();
$response['order_address']= array();
$response['order_payment']= array();
switch ($action) {
  case "get_product_by_id":
    $product = $products->GetproductById($_GET['product_id']);
    echo json_encode($product);
    break;
  case "get_address_by_id":
    $address = $dba->getAddressByUserId($_GET['userId']);
    echo json_encode($address);
    break;
  case "get_all_addresses_by_id":
    $addresses = $dba->getAllAddressesByUserId($_GET['userId']);
    echo json_encode($addresses);
    break;


  case "submit_order":
    $today = date("dmY");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $uniqueOrderNo = $today . $rand;
    $response = array();
    $userId = $_POST['hiddenuser'];
    $addressId = $_POST['hiddenaddress'];
    $payment = $_POST['hiddenpayment'];
    $order_total = $_POST['order_total_pay_value'];
    $order_otherfees = $_POST['order_otherfees_value'];
    $order_shipmentfees = $_POST['order_shipmentfees_value'];
    $paymentfees = $_POST['paymentfees'];
    // $walletId = $_POST['hiddenwalletId'];
    $walletId = 0;
    $usercart = $carts->GetCartSuppliersByUserId($userId);
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
    $refs = new Cart('ref');
    $ref = $refs->get(1);
    if (isset($ref)) {
      $ref_id=$ref->ref;
      $status=$ref->status;
    }else {
      $ref_id="0";
      $status="Pending";
    }
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
      $shipment_country = $dba->getAddressById($addressId)['country'];
      if ($shipment_type==1) {
        if($shipment_country=="OM"){
          if ($totalSellerWeight<=30) {
            $shipment_fees =$dbo->getAsyadRate($totalSellerWeight)['price'];
          }else {
            $shipment_fees =0;
          }
        }else{
          if ($totalSellerWeight<=5) {
            $shipment_fees =16;
          }elseif ($totalSellerWeight>30) {
            $shipment_fees =0;
            break;
          }else{
            $extra =  ($weight-5)*2;
            $shipment_fees =16+$extra;
          }
        }
      }else {
        $shipment_fees =0;
      }
      // $payment_type_fees = $dbw->GetPaymentFeesById($payment_type);
      // $buyerpaymentfees = $payment_type_fees['percentage'];
      // if ($payment_type==1) $buyer_payment_fees = $totalSeller*$buyerpaymentfees+2;
      // else $buyer_payment_fees = $totalSeller*$buyerpaymentfees;
      $buyer_payment_fees = 0;
      $seller_payment_type_fees = $dbw->GetPaymentSellerFeesById($payment_type);
      if ($seller_payment_type_fees) {
        $payment_fees = $totalSeller*($seller_payment_type_fees['percentage']+$paymentfees);
      }else {
        $payment_fees = 0;
      }
      if ($payment_type==1) {
        $payment_fees = $payment_fees+2;
      }
      $usercartproducts = $carts->GetBuyerSellerCart($userId,$sellerId);
      $order_totalPrice = floatval($totalSeller)-$promotion;
      $ord = $dbo->addOrder($handling, $userId, $sellerId, $orderNumber,$taxNumber, $totalSellerQuantity, $order_totalPrice, $totalSellerWeight, $shipment_type, $statusId, $addressId, $walletId, $active);
      $orderId = $ord[0]['insertId'];
      $response['orderNumber']=$orderNumber;
      $total_payment = $totalSeller+$shipment_fees+$buyer_payment_fees;
      $total_payment = $total_payment+($total_payment*0.05);
      $pay_seller = $pay=$dbo->AddOrderToSellerPayments($orderId, $orderNumber, $payment_type, round($payment_fees,2), round($shipment_fees,2),0, round($total_payment,2), NULL, "Pending");
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
        $seller_info = $db->getUserById($detailitem['sellerId']);
        $store_info = $db->getUserCompany($seller_info['usercompanyId']);
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
              $mails->Password   = 'Notify@pomechain21';                               // SMTP password
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
      /*ship with asayed*/
      if ($shipment_country=="OM") {
        $client->request('GET', DIR_ROOT . DIR_API . 'asyadexpress/asyad.php?action=createshipment&orderId='.$orderId);
      }
    }
    switch ($payment) {
      case '1':
        $pay_buyer=$dbo->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
        break;
      case '2':
        $pay_buyer=$dbo->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
        break;
      case '3':
        $pay_buyer=$dbo->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),8, round($order_total,2), NULL, "Pending");
        break;
      default:
        $pay_buyer=$dbo->AddOrderToBuyerPayments($orderNumber,$payment_type,round($order_otherfees,2),round($order_shipmentfees,2),0, round($order_total,2), NULL, "Pending");
        break;
    }
    if (isset($ref)) $refs->clear();
    /*send buyer notification*/
    $user_info = $db->getUserById($userId);
    $order_address = $dba->getAddressById($addressId);
    $notification_email=$user_info['email'];
    $notification_fullname=urlencode($user_info['fullname']);
    $deleteCart = new Ser_Orders();
    $deleteCart = $deleteCart->DeleteAllCartByUserId($userId);
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
          $mail->Password   = 'Notify@pomechain21';                               // SMTP password
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
          $mail_acc->Password   = 'Notify@pomechain21';                               // SMTP password
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
    break;

  case "get_notification":
    $id = $_GET['userId'];
    $type = 'new_order';
    $notif = new Notif();
    $notif = $notif->getNotification($id, $type);
    echo json_encode($notif);
    break;

  case "change_notification_status":
    $id = 1;
    $type = 'new_order';
    $notif = new Notif();
    $notif = $notif->changeNotificationStatus($id, $type);
    echo json_encode($notif);
    break;

  case "get_wishlist":

    $wishlist = new WishList();
    $wishlist = $wishlist->getMyWishList($_GET['userId']);
    echo json_encode($wishlist);
    break;

  case "delete_wishlist":

    $wishlist = new WishList();
    $delete = $wishlist->deleteWishList($_GET['id'], $_GET['userId']);
    header("location:" . DIR_VIEW . DIR_CAR . "wishlist.php?wishlist=deleted");

    break;

  case "add_to_wishlist":
    $uid = $_POST['userId'];
    $sid = $_POST['sellerId'];
    $pid = $_POST['productId'];
    $wishlist = new WishList();
    if ($exist = $wishlist->checkIfWishListExist($uid, $pid)) {
      if (isset($_POST['productId'])) {
        header("location:" . DIR_VIEW . 'products/productdetails.php?productId=' . $pid . '&wishlist=alreadyaddedtowishlist');
      } else {
        header("location:" . DIR_VIEW . DIR_CAR . "cart.php?wishlist=alreadyaddedtowishlist");
      }
    } else {

      $added = $wishlist->addToWishList($uid, $sid, $pid);
      if (isset($_POST['product'])) {
        header("location:" . DIR_VIEW . 'products/productdetails.php?productId=' . $pid . '&wishlist=addedtowishlist');
      } else {
        header("location:" . DIR_VIEW . DIR_CAR . "cart.php?wishlist=addedtowishlist");
      }
    }

    break;
  case "addtowishlist":
    $uid = $_GET['userId'];
    $sid = $_GET['sellerId'];
    $pid = $_GET['productId'];
    $wishlist = new WishList();
    if ($exist = $wishlist->checkIfWishListExist($uid, $pid)) {
        return 1;
    } else {
      $added = $wishlist->AddToWishList($uid, $sid, $pid);
      return 0;
    }
    break;

  case "get_received_order_details":
    $orderdetailId = $_GET['orderdetailId'];
    $order_Details = $dbd->GetOrderdetailById($orderdetailId);
    array_push($response['orderdetails'],$order_Details);
    $order = $dbo->GetOrderById($order_Details['orderId']);
    array_push($response['order'],$order);
    $user_info = $db->getUserById($order['userId']);
    array_push($response['user_info'],$user_info);
    $order_address = $dba->getAddressById($order['addressId']);
    array_push($response['order_address'],$order_address);
    $order_payment = $dbo->getPaymentByOrderId($order_Details['orderId']);
    array_push($response['order_payment'],$order_payment);
    $orderDetails_shipment = $dbo->GetshipmentByOrderId($order_Details['orderId']);
    if ($orderDetails_shipment) {
      array_push($response['order_shipment'],$orderDetails_shipment);
    }else {
      $response['order_shipment']=NULL;
    }
    echo json_encode($response);
    break;

  case "submit_quotation":
    $userId = $_POST['userId'];
    $sellerId = $_POST['sellerId'];
    $productId = $_POST['productId'];
    $requiredBy = $_POST['required_by'];

    $quotation = $dbo->AddQuotation($userId, $sellerId, $productId, $requiredBy);

    $quotation_id = $quotation['insertId'];
    $quantity = $_POST['quantity'];
    $buyer_price = $_POST['offered_price'];
    $comment = $_POST['comment'];

    $negotiation = new Ser_Orders();
    $negotiation = $dbo->createNegotiation($quotation_id, $quantity, $buyer_price, $comment);
    $date = date('Y-m-d');

    if ($negotiation == true) {
      header('location: ' . DIR_VIEW . DIR_ORD . 'my-quotations.php?from=' . $date . '&to=' . $date . '&quotation=success');
    } else {
      echo "There is some error";
      exit();
    }
    break;

  case "get_quotations":
    $userId = $_GET['userId'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $quotations = new Ser_Orders();
    $quotations = $quotations->GetQuotations($userId, $from, $to);
    echo json_encode($quotations);

    break;

  case "get_seller_quotations":
    $userId = $_GET['userId'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $quotations = new Ser_Orders();
    $quotations = $quotations->GetSellerQuotations($userId, $from, $to);
    echo json_encode($quotations);

    break;

  case "get_seller_quotation_by_id":
    $userId = $_GET['userId'];
    $quotationId = $_GET['qid'];
    $quotations = new Ser_Orders();
    $quotations = $quotations->GetSellerQuotationById($quotationId, $userId);
    echo json_encode($quotations);

    break;
  case "get_buyer_quotation_by_id":
    $userId = $_GET['userId'];
    $quotationId = $_GET['qid'];
    $quotations = new Ser_Orders();
    $quotations = $quotations->GetBuyerQuotationById($quotationId, $userId);
    echo json_encode($quotations);

    break;

  case "change_quotation_status":

    $negotiationId = $_POST['negotiationId'];
    $status = $_POST['status'];
    $comment = ($status == 6 ? 'accepted by the seller' : 'cancelled by the seller');
    $nstatus = ($status == 6 ? 6 : 4);
    $negotiation = $dbo->ChangeNegotiationStatus($negotiationId, $nstatus, $comment);
    $negotiation_details = $dbo->getNegotiationDetailsById($negotiationId);

    if ($negotiation_details['statusId'] == 6) {
      $quoid = $negotiation_details['quotationId'];
      $quoqty = $negotiation_details['quantity'];
      if ($negotiation_details['seller_price'] !== NULL) {
        $quoprice = $negotiation_details['seller_price'];
      } else {
        $quoprice = $negotiation_details['buyer_price'];
      }
      $quostatus = 6;
      $quotation = $dbo->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
    } elseif ($negotiation_details['statusId'] == 4) {
      $quoid = $negotiation_details['quotationId'];
      $quoqty = NULL;
      $quoprice = NULL;
      $quostatus = 4;
      $quotation = $dbo->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
    }

    $status = 'modified';
    header('location: ' . DIR_VIEW . 'orders/received-quotations.php?quotation=q' . $status);

    break;

  case "modify_quotation_by_seller":

    $qid = $_POST['qid'];
    $qqty = $_POST['mfquantity'];
    $buyerprice = $_POST['mfofferedprice'];
    $sellerprice = $_POST['mffinalprice'];
    $quotation = $dbo->ModifyQuotationBySeller($qid, $qqty, $buyerprice, $sellerprice);
    $status = 'modified';
    if ($quotation == true) {
      header('location: ' . DIR_VIEW . 'orders/received-quotations.php?quotation=q' . $status);
    } else {
      echo "There is some error";
      exit();
    }

    break;

  case "modify_quotation_by_buyer":

    $qid = $_POST['qid'];
    $qqty = $_POST['mfquantity'];
    $buyerprice = $_POST['mfofferedprice'];
    $sellerprice = $_POST['mffinalprice'];
    $quotation = $dbo->ModifyQuotationByBuyer($qid, $qqty, $buyerprice, $sellerprice);
    $status = 'modified';
    if ($quotation == true) {
      header('location: ' . DIR_VIEW . 'orders/my-quotations.php?quotation=q' . $status);
    } else {
      echo "There is some error";
      exit();
    }

    break;

  case "get_negotiations_of_quotation":

    $quotationId = $_GET['qid'];
    $negotiations = new Ser_Orders();
    $negotiations = $negotiations->GetNegotiationsOfQuotation($quotationId);
    echo json_encode($negotiations);

    break;

  case "change_quotation_status_by_buyer":

    $negotiationId = $_POST['negotiationId'];
    $status = $_POST['status'];
    $comment = ($status == 6 ? 'accepted by the buyer' : 'cancelled by the buyer');
    $nstatus = ($status == 6 ? 6 : 4);
    $negotiation = new Ser_Orders();
    $negotiation = $dbo->ChangeNegotiationStatusByBuyer($negotiationId, $nstatus, $comment);
    $negotiation_details = $dbo->getNegotiationDetailsById($negotiationId);
    if ($negotiation_details['statusId'] == 6) {
      $quoid = $negotiation_details['quotationId'];
      $quoqty = $negotiation_details['quantity'];
      if ($negotiation_details['seller_price'] !== NULL) {
        $quoprice = $negotiation_details['seller_price'];
      } else {
        $quoprice = $negotiation_details['buyer_price'];
      }
      $quostatus = 6;
      $quotation = $dbo->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
    } elseif ($negotiation_details['statusId'] == 4) {
      $quoid = $negotiation_details['quotationId'];
      $quoqty = NULL;
      $quoprice = NULL;
      $quostatus = 4;
      $quotation = $dbo->ChangeQuotationStatus($quoid, $quoqty, $quoprice, $quostatus);
    }

    $status = 'modified';
    header('location: ' . DIR_VIEW . 'orders/my-quotations.php?quotation=q' . $status);

    break;

  case "get_delivery_options":

    $delivery = new Ser_Delivery();
    $delivery = $delivery->GetDeliveryFee();
    echo json_encode($delivery);

    break;

  default:
    echo "Please declare your function name";
}
