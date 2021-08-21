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
require_once '../../../' . DIR_MOD . 'Ser_Wallets.php';/*call carts class*/

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$client = new GuzzleHttp\Client();


$db = new Ser_Users();
$dbc = new Ser_Carts();
$dbo = new Ser_Orders();
$products = new Ser_Products();
$notifications = new Ser_Notif();
$dbw = new Ser_Wallets();/*create carts instance*/
$dba = new Ser_Addresses();
use Anam\Phpcart\Cart;

$action = $_GET['action'];
$response['err']=-1;
$response['cart_count'] = 0;
$response['order']=array();
$response['payment']=array();
$response['carts']=array();
$response['carts_suppliers'] = array();/*array of carts*/
$response['supplier_info'] = array();
$response['supplier_cart'] = array();
$response['seller_info']=array();
$response['seller_company']=array();
$response['buyer_info']=array();
$response['buyer_company']=array();
$response['seller_default_address']=array();
$response['buyer_default_address']=array();
$response['buyer_seller_cart']=array();
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

    $order = new Ser_Orders();
    $cart = new Cart();

    $today = date("dmY");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 6));
    $uniqueOrderNo = $today . $rand;
    $response = array();
    $userId = $_POST['hiddenuser'];
    $address = $_POST['hiddenaddress'];
    $payment = $_POST['hiddenpayment'];
    $walletId = $_POST['hiddenwalletId'];
    $response['address'] = $address;
    $response['payment'] = $payment;
    $response['cart'] = $cart->getItems();
    $orderNumber = $uniqueOrderNo;
    $totalQuantity = $cart->totalQuantity();
    $totalPrice = $cart->getTotal();
    $statusId = 1;
    $blockId = 1;
    $addressId = $response['address'];
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

    $tax=$_POST['hiddentax'];
    $payment_fees=0;
    $jb_fees=0;
    $total_price=$_POST['hiddentotal'];
    $response['payment']=$order->AddOrderToPayments($tax, $payment_fees, $jb_fees, $total_price, $ref_id, $status);
    $purchaseId = $response['payment']['insertId'];
    if (isset($ref)) $refs->clear();
    /* PAYMENTS TABLE */

    $response['order'] = $order->addOrder($userId, $orderNumber, $purchaseId, $totalQuantity, $totalPrice, $statusId, $blockId, $addressId, $walletId, $active);
    foreach ($cart->getItems() as $item) {
      $orderDetails = new Ser_Orderdetails();
      $orderId = $response['order']['insertId'];
      $productId = $item->id;
      $supplierId = $item->seller_id;
      $order_number = $uniqueOrderNo;
      $discount = 0;
      $quantity = $item->quantity;
      $totalprice = $item->price;
      $shipperId = 1;
      $statusId = 1;
      $blockId = 1;
      $active = 1;
      $response['details'] = $orderDetails->addOrderdetail($orderId, $productId, $supplierId, $order_number, $discount, $quantity, $totalprice, $shipperId, $statusId, $blockId, $active);
      $update_supplier_inv = $products->updateInventoryless($supplierId, $productId, $quantity);
      $update_product_inv = $products->updateTotalInventoryless($productId, $quantity);
      /*send seller notification*/
      $seller_info = $db->getUserById($supplierId);
      $seller_notification_email=$seller_info['email'];
      $seller_notification_fullname=urlencode($seller_info['fullname']);
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
            $mails->Subject = 'Your Order has been sent.';
            $temp_url= DIR_ROOT."mail/templates/new_order.php?name=$seller_notification_fullname&orderId=$orderId";
            $msg =file_get_contents($temp_url);
            $mails->Body    = $msg;
            $mails->send();
            $response['err']=0;
        } catch (Exception $e) {
            $response['err']=1;
        }
      }
    }

    $user_info = $db->getUserById($userId);
    $notification_email=$user_info['email'];
    $notification_fullname=$user_info['fullname'];

    $notif = $notifications->AddUserNotification($supplierId, $orderId, 1);
    $cart->clear();
    $deleteCart = new Ser_Orders();
    $deleteCart = $deleteCart->DeleteAllCartByUserId($userId);
    /* Send Email */
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
        $temp_url= DIR_ROOT."mail/templates/new_order.php?name=$notification_fullname&orderId=$orderId";
        $msg =file_get_contents($temp_url);
        $mail->Body    = $msg;
        $mail->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
    /* Send Email */
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

  case "get_received_order_details":
    $id = $_GET['orderId'];
    $orderDetails = new Ser_Orders();
    $orderDetails = $orderDetails->GetReceivedOrderDetails($id);
    echo json_encode($orderDetails);
    break;

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

    $negotiation = new Ser_Orders();
    $negotiation = $negotiation->createNegotiation($quotation_id, $quantity, $buyer_price, $comment);
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
    $qid = $_GET['id'];
    $quotations = new Ser_Orders();
    $quotations = $quotations->GetSellerQuotationById($qid, $userId);
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

    $negoid = $_POST['negoid'];
    $sid = 1;
    $status = $_POST['status'];
    $comment = ($status == 'accepted' ? 'accepted by the seller' : 'cancelled by the seller');
    $nstatus = ($status == 'accepted' ? 'closed' : 'cancelled');
    //var_dump($_POST);
    //exit();
    $negotiation = new Ser_Orders();
    $negotiation = $negotiation->ChangeNegotiationStatus($negoid, $sid, $nstatus, $comment);


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
    header('location: ' . DIR_VIEW . 'orders/received-quotations.php?quotation=q' . $status);

    break;

  case "modify_quotation_by_seller":

    $qid = $_POST['qid'];
    $qqty = $_POST['mfquantity'];
    $buyerprice = $_POST['mfofferedprice'];
    $sellerprice = $_POST['mffinalprice'];
    $sid = 1;

    $quotation = new Ser_Orders();
    $quotation = $quotation->ModifyQuotationBySeller($qid, $qqty, $buyerprice, $sellerprice);
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
    return $quotation;

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
    break;
  case "add_to_cart":
    $check = $dbc->isExist_Cart($_POST['userId'],$_POST['productId']);
    if ($check) {
      $updated_quantity = $check['quantity']+$_POST['quantity'];
      $dbc->updateCart($_POST['userId'],$_POST['productId'], $updated_quantity );
    }else {
      $dbc->addCart($_POST['userId'], $_POST['productId'], $_POST['sellerId'], $_POST['pname'], $_POST['pprice'], $_POST['quantity'], $_POST['weight'], 1);
    }
    break;
    case "update_to_cart":
      $check = $dbc->isExist_Cart($_POST['userId'],$_POST['productId']);
      if ($check) {
        $dbc->updateCart($_POST['userId'],$_POST['productId'], $_POST['quantity']);
      }else {
        $dbc->addCart($_POST['userId'], $_POST['productId'], $_POST['sellerId'], $_POST['pname'], $_POST['pprice'], $_POST['quantity'], 1);
      }
      break;
  case "get_cart":
    $userId = $_POST['userId'];
    $carts = $dbc ->GetCartByUserId($userId);/*fetch all user carts*/
    if ($carts) {
      foreach ($carts as $cart) {
        array_push($response['carts'], $cart);
      }
    }
    echo json_encode($response['carts']);
    break;
  case "upload_cart":
    $cart = $_POST['cartitems'];
    $cart_json = json_decode($cart,true);
    foreach ($cart_json as $item) {
      $check = $dbc->isExist_Cart($_POST['userId'],$item['productId']);
      if ($check) {
        $dbc->updateCart($_POST['userId'],$item['productId'], $item['quantity']);
      }else {
        $dbc->addCart($_POST['userId'], $item['productId'], $item['sellerId'], $item['name'], $item['price'], $item['quantity'], $item['weight'], 1);
      }
    }
    break;
  case "delete_cart":
    $deleted = $dbc->DeleteCartByUserId($_POST['productId'], $_POST['userId']);/*remove product from cart*/
    if ($deleted) {
      $response['err'] = 0;
    } else {
      $response['err'] = 1;/*failed delete due to database error*/
    }
    break;
  case "update_product_shipment":
    $cartId=$_POST['cartId'];
    $type=$_POST['shipment_type'];
    $carts = $dbc->UpdateProductShipment($cartId,$type);/*fetch all user carts*/
    if ($carts) {
      $response['err'] = 0;
    }else {
      $response['err'] = 1;
    }
    echo json_encode($response['err']);
    break;
  case "get-suppliers":
    $userId = $_POST['userId'];
    $carts = $dbc->GetCartSuppliersByUserId($userId);/*fetch all user carts*/
    if ($carts) {
      foreach ($carts as $cart) {
        $wired = $dbw->GetBankBySellerId($cart['sellerId']);/*fetch all user carts*/
        $address = $dba->getDefaultAddressByUserId($cart['sellerId']);
        if ($address) {
          $cart['latitude'] = $address['latitude'];
          $cart['longitude'] = $address['longitude'];
        }else {
          $cart['latitude'] = 0;
          $cart['longtitude'] = 0;
        }
        if ($wired) {
          $cart['wired'] = 1;
          $cart['account_number'] = $wired['account_number'];
          $cart['account_name'] = $wired['account_name'];
          $cart['bank_name'] = $wired['bank_name'];
          $cart['iban'] = $wired['iban'];
          $cart['swift_code'] = $wired['swift_code'];
          $cart['currency'] = $wired['currency'];
        }else {
          $cart['wired'] = 0;
        }
        array_push($response['carts_suppliers'], $cart);
      }
    }
    echo json_encode($response['carts_suppliers']);
    break;
  case "get-usercart-seller":
    $totalPrice = 0;
    $sellerId=$_POST['sellerId'];
    $userId=$_POST['userId'];
    $carts = $dbc->GetUserCartBySuppliers($userId,$sellerId);/*fetch all user carts*/
    foreach ($carts as $item) {
      array_push($response['supplier_cart'],$item);
    }
    echo json_encode($response);
    break;
  case "get-proforminvoice":
    $userId=$_GET['userId'];
    $sellerId=$_GET['sellerId'];
    $seller = $db->getUserById($sellerId);
    array_push($response['seller_info'],$seller);
    $usercompanyId=$seller['usercompanyId'];
    $company = $db->getUserCompany($usercompanyId);
    array_push($response['seller_company'],$company);
    $address = $dba->getDefaultAddressByUserId($sellerId);
    array_push($response['seller_default_address'],$address);
    $buyer = $db->getUserById($userId);
    array_push($response['buyer_info'],$buyer);
    if ($buyer['usercompanyId']!=0) {
      $buyercompanyId=$buyer['usercompanyId'];
      $buyercompany = $db->getUserCompany($buyercompanyId);
      array_push($response['buyer_company'],$buyercompany);
    }else {
      $response['buyer_company']=null;
    }
    $address_buyer = $dba->getDefaultAddressByUserId($userId);
    array_push($response['buyer_default_address'],$address_buyer);
    $cart_buyer_seller = $dbc->GetBuyerSellerCart($userId,$sellerId);
    if ($cart_buyer_seller) {
      foreach ($cart_buyer_seller as $item) {
        array_push($response['buyer_seller_cart'],$item);
      }
    }else {
      $response['buyer_seller_cart'] = NULL;
    }
    echo json_encode($response);
    break;
    case "update-product-payment":
        $userId=$_POST['userId'];
        $type=$_POST['payment_type'];
        $carts = $dbc->UpdateProductPayment($userId,$type);/*fetch all user carts*/
      break;
    case "update-product-shipment":
      $userId=$_POST['userId'];
      $type=$_POST['shipment_type'];
      $carts = $dbc->UpdateProductShipment($userId,$type);/*fetch all user carts*/
      break;
    case "get-cartcount":
      $userId=$_POST['userId'];
      $carts = $dbc->GetCartCount($userId);/*fetch all user carts*/
      if ($carts) {
        $response['cart_count'] = $carts['countc'];
      }else {
        $response['cart_count'] = 0;
      }
      echo json_encode($response['cart_count']);
      break;
  default:
    echo "Please declare your function name";
}
